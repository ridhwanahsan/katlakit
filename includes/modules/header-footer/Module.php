<?php
/**
 * Header Footer Builder Module
 *
 * @package KatlaKit\Modules
 */

namespace KatlaKit\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Header_Footer
 */
class Header_Footer {

	/**
	 * Builder post type slug.
	 */
	public const POST_TYPE = 'katlakit_template';

	/**
	 * Template type post meta key.
	 */
	private const META_TEMPLATE_TYPE = '_katlakit_template_type';

	/**
	 * Display rules post meta key.
	 */
	private const META_DISPLAY_RULES = '_katlakit_display_rules';

	/**
	 * Exclusion rules post meta key.
	 */
	private const META_EXCLUSION_RULES = '_katlakit_exclusion_rules';

	/**
	 * Template settings nonce action.
	 */
	private const NONCE_ACTION = 'katlakit_save_template_settings';

	/**
	 * AJAX search nonce action.
	 */
	private const SEARCH_NONCE_ACTION = 'katlakit_header_footer_search';

	/**
	 * Singleton instance.
	 *
	 * @var Header_Footer|null
	 */
	private static $instance = null;

	/**
	 * Matched header template ID.
	 *
	 * @var int|false
	 */
	private $header_id = false;

	/**
	 * Matched before footer template ID.
	 *
	 * @var int|false
	 */
	private $before_footer_id = false;

	/**
	 * Matched footer template ID.
	 *
	 * @var int|false
	 */
	private $footer_id = false;

	/**
	 * Plugin settings.
	 *
	 * @var array
	 */
	private $settings = [];

	/**
	 * Get the module instance.
	 *
	 * @return Header_Footer
	 */
	public static function instance(): Header_Footer {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Boot all hooks.
	 */
	private function __construct() {
		$this->settings = get_option( 'katlakit_settings', [] );
		add_action( 'init', [ $this, 'register_cpt' ] );
		add_action( 'init', [ $this, 'register_shortcode' ] );
		add_action( 'wp', [ $this, 'resolve_active_templates' ] );
		add_filter( 'body_class', [ $this, 'add_body_classes' ] );
		add_action( 'wp_head', [ $this, 'inject_header_styles' ] );
		add_action( 'wp_body_open', [ $this, 'inject_header' ], 1 );
		add_action( 'wp_footer', [ $this, 'inject_before_footer' ], 0 );
		add_action( 'wp_footer', [ $this, 'inject_footer' ], 1 );

		add_action( 'elementor/documents/register', [ $this, 'register_document_type' ] );
		add_filter( 'elementor/template_library/sources', [ $this, 'register_source' ], 10, 1 );
		add_action( 'admin_action_katlakit_set_template', [ $this, 'handle_set_template' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
		add_action( 'wp_ajax_katlakit_header_footer_search_targets', [ $this, 'ajax_search_targets' ] );

		add_action( 'add_meta_boxes', [ $this, 'register_meta_boxes' ] );
		add_action( 'save_post_' . self::POST_TYPE, [ $this, 'save_template_settings' ] );
		add_filter( 'manage_' . self::POST_TYPE . '_posts_columns', [ $this, 'register_admin_columns' ] );
		add_action( 'manage_' . self::POST_TYPE . '_posts_custom_column', [ $this, 'render_admin_column' ], 10, 2 );
		add_filter( 'display_post_states', [ $this, 'add_template_state_labels' ], 10, 2 );
		add_filter( 'use_block_editor_for_post_type', [ $this, 'disable_block_editor' ], 10, 2 );
		add_filter( 'enter_title_here', [ $this, 'filter_title_placeholder' ], 10, 2 );
	}

	/**
	 * Register the builder post type.
	 *
	 * @return void
	 */
	public function register_cpt(): void {
		$labels = [
			'name'               => esc_html__( 'Header Footer', 'katlakit' ),
			'singular_name'      => esc_html__( 'Header Footer', 'katlakit' ),
			'menu_name'          => esc_html__( 'Header Footer', 'katlakit' ),
			'add_new'            => esc_html__( 'Add New', 'katlakit' ),
			'add_new_item'       => esc_html__( 'Add New Header Footer', 'katlakit' ),
			'edit_item'          => esc_html__( 'Edit Header Footer', 'katlakit' ),
			'new_item'           => esc_html__( 'New Header Footer', 'katlakit' ),
			'all_items'          => esc_html__( 'Header Footer', 'katlakit' ),
			'view_item'          => esc_html__( 'View Header Footer', 'katlakit' ),
			'search_items'       => esc_html__( 'Search Header Footer', 'katlakit' ),
			'not_found'          => esc_html__( 'No header footer found.', 'katlakit' ),
			'not_found_in_trash' => esc_html__( 'No header footer found in Trash.', 'katlakit' ),
		];

		register_post_type(
			self::POST_TYPE,
			[
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'menu_icon'           => 'dashicons-layout',
				'show_ui'             => true,
				'show_in_menu'        => 'katlakit',
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => [ 'title', 'thumbnail', 'elementor' ],
				'show_in_rest'        => true,
				'publicly_queryable'  => true,
			]
		);
	}

	/**
	 * Register the Elementor document type for this post type.
	 *
	 * @param mixed $documents_manager Elementor documents manager.
	 * @return void
	 */
	public function register_document_type( $documents_manager ): void {
		if ( class_exists( KK_HF_Document::class ) ) {
			$documents_manager->register_document_type( KK_HF_Document::get_type(), KK_HF_Document::class );
		}
	}

	/**
	 * Check whether the builder module is enabled in settings.
	 *
	 * @return bool
	 */
	public function is_builder_enabled(): bool {
		return isset( $this->settings['enable_header_footer'] ) && '1' === (string) $this->settings['enable_header_footer'];
	}

	/**
	 * Stub for template library sources.
	 *
	 * @param array $sources Existing sources.
	 * @return array
	 */
	public function register_source( $sources ) {
		return $sources;
	}

	/**
	 * Enqueue builder-only admin assets.
	 *
	 * @return void
	 */
	public function enqueue_admin_assets(): void {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

		if ( ! $screen || self::POST_TYPE !== $screen->post_type ) {
			return;
		}

		wp_enqueue_style(
			'katlakit-header-footer-admin',
			plugins_url( 'includes/modules/header-footer/header-footer.css', KATLAKIT_FILE ),
			[],
			KATLAKIT_VERSION
		);

		wp_enqueue_script(
			'katlakit-header-footer-admin',
			plugins_url( 'includes/modules/header-footer/header-footer.js', KATLAKIT_FILE ),
			[ 'jquery' ],
			KATLAKIT_VERSION,
			true
		);

		wp_localize_script(
			'katlakit-header-footer-admin',
			'katlakitHeaderFooter',
			[
				'ajaxUrl'           => admin_url( 'admin-ajax.php' ),
				'nonce'             => wp_create_nonce( self::SEARCH_NONCE_ACTION ),
				'action'            => 'katlakit_header_footer_search_targets',
				'searchPlaceholder' => esc_html__( 'Search pages / post / categories', 'katlakit' ),
				'searchMinimum'     => esc_html__( 'Type at least 2 characters.', 'katlakit' ),
				'searching'         => esc_html__( 'Searching...', 'katlakit' ),
				'noResults'         => esc_html__( 'No matches found.', 'katlakit' ),
			]
		);
	}

	/**
	 * AJAX search for specific pages, posts, and taxonomy terms.
	 *
	 * @return void
	 */
	public function ajax_search_targets(): void {
		check_ajax_referer( self::SEARCH_NONCE_ACTION, 'nonce' );

		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error(
				[
					'message' => esc_html__( 'You are not allowed to do that.', 'katlakit' ),
				],
				403
			);
		}

		$keyword = isset( $_GET['keyword'] ) ? sanitize_text_field( wp_unslash( $_GET['keyword'] ) ) : '';

		if ( strlen( $keyword ) < 2 ) {
			wp_send_json_success(
				[
					'items' => [],
				]
			);
		}

		$results = [];

		$post_types = get_post_types(
			[
				'public' => true,
			],
			'objects'
		);

		unset( $post_types['attachment'], $post_types[ self::POST_TYPE ] );

		$posts = get_posts(
			[
				'post_type'      => array_keys( $post_types ),
				'post_status'    => [ 'publish', 'private', 'draft', 'pending', 'future' ],
				'posts_per_page' => 10,
				's'              => $keyword,
				'orderby'        => 'date',
				'order'          => 'DESC',
			]
		);

		foreach ( $posts as $post ) {
			$post_type_object = get_post_type_object( $post->post_type );
			$post_title       = '' !== $post->post_title ? $post->post_title : esc_html__( '(no title)', 'katlakit' );

			$results[] = [
				'value' => 'specific:post:' . $post->ID,
				'label' => sprintf(
					/* translators: 1: post title, 2: post type label. */
					esc_html__( '%1$s (%2$s)', 'katlakit' ),
					$post_title,
					$post_type_object ? $post_type_object->labels->singular_name : $post->post_type
				),
			];
		}

		$taxonomies = get_taxonomies(
			[
				'public' => true,
			],
			'objects'
		);

		foreach ( $taxonomies as $taxonomy ) {
			if ( 'post_format' === $taxonomy->name ) {
				continue;
			}

			$terms = get_terms(
				[
					'taxonomy'   => $taxonomy->name,
					'hide_empty' => false,
					'search'     => $keyword,
					'number'     => 5,
				]
			);

			if ( is_wp_error( $terms ) || empty( $terms ) ) {
				continue;
			}

			foreach ( $terms as $term ) {
				$results[] = [
					'value' => 'specific:term:' . $taxonomy->name . ':' . $term->term_id,
					'label' => sprintf(
						/* translators: 1: term name, 2: taxonomy label. */
						esc_html__( '%1$s (%2$s)', 'katlakit' ),
						$term->name,
						$taxonomy->labels->singular_name
					),
				];
			}
		}

		wp_send_json_success(
			[
				'items' => array_slice( $results, 0, 20 ),
			]
		);
	}

	/**
	 * Register the frontend shortcode.
	 *
	 * @return void
	 */
	public function register_shortcode(): void {
		add_shortcode( 'katlakit_template', [ $this, 'render_template_shortcode' ] );
	}

	/**
	 * Render a template via shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
	public function render_template_shortcode( array $atts ): string {
		$atts = shortcode_atts(
			[
				'id' => 0,
			],
			$atts,
			'katlakit_template'
		);

		$template_id = absint( $atts['id'] );

		if ( $template_id < 1 || ! class_exists( '\Elementor\Plugin' ) ) {
			return '';
		}

		return (string) \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id, true );
	}

	/**
	 * Resolve active templates for the current frontend request.
	 *
	 * @return void
	 */
	public function resolve_active_templates(): void {
		$this->header_id        = false;
		$this->before_footer_id = false;
		$this->footer_id        = false;

		if ( is_admin() || ! $this->is_builder_enabled() ) {
			return;
		}

		$this->header_id        = $this->find_matching_template_id( 'header' );
		$this->before_footer_id = $this->find_matching_template_id( 'before_footer' );
		$this->footer_id        = $this->find_matching_template_id( 'footer' );

		if ( ! $this->header_id ) {
			$this->header_id = $this->get_legacy_template_id( 'header' );
		}

		if ( ! $this->before_footer_id ) {
			$this->before_footer_id = $this->get_legacy_template_id( 'before_footer' );
		}

		if ( ! $this->footer_id ) {
			$this->footer_id = $this->get_legacy_template_id( 'footer' );
		}
	}

	/**
	 * Add body classes when templates are active.
	 *
	 * @param array $classes Existing body classes.
	 * @return array
	 */
	public function add_body_classes( array $classes ): array {
		if ( $this->header_id ) {
			$classes[] = 'katlakit-custom-header';
		}

		if ( $this->before_footer_id ) {
			$classes[] = 'katlakit-custom-before-footer';
		}

		if ( $this->footer_id ) {
			$classes[] = 'katlakit-custom-footer';
		}

		return $classes;
	}

	/**
	 * Output inline CSS for header/footer replacement.
	 *
	 * @return void
	 */
	public function inject_header_styles(): void {
		if ( ! $this->is_builder_enabled() ) {
			return;
		}

		$css = '';

		if ( $this->header_id ) {
			$css .= '
			.site-header,header.header,#masthead,#site-header,
			.navbar,.nav-bar,.header-area,.top-bar,
			.elementor-location-header{display:none!important}
			.katlakit-hf-header{position:relative;z-index:9999;width:100%}
			';
		}

		if ( $this->footer_id ) {
			$css .= '
			.site-footer,footer.footer,#colophon,#site-footer,
			.footer-area,.elementor-location-footer{display:none!important}
			.katlakit-hf-footer{position:relative;z-index:100;width:100%}
			';
		}

		if ( $this->before_footer_id ) {
			$css .= '
			.katlakit-hf-before-footer{position:relative;z-index:90;width:100%}
			';
		}

		if ( $css ) {
			printf( '<style id="katlakit-hf-css">%s</style>', $css ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	/**
	 * Inject the matched header template.
	 *
	 * @return void
	 */
	public function inject_header(): void {
		if ( ! $this->header_id || ! class_exists( '\Elementor\Plugin' ) ) {
			return;
		}

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			return;
		}

		echo '<div class="katlakit-hf-header katlakit-hf-wrap">';
		echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $this->header_id, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div>';
	}

	/**
	 * Inject the matched before footer template.
	 *
	 * @return void
	 */
	public function inject_before_footer(): void {
		if ( ! $this->before_footer_id || ! class_exists( '\Elementor\Plugin' ) ) {
			return;
		}

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			return;
		}

		echo '<div class="katlakit-hf-before-footer katlakit-hf-wrap">';
		echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $this->before_footer_id, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div>';
	}

	/**
	 * Inject the matched footer template.
	 *
	 * @return void
	 */
	public function inject_footer(): void {
		if ( ! $this->footer_id || ! class_exists( '\Elementor\Plugin' ) ) {
			return;
		}

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			return;
		}

		echo '<div class="katlakit-hf-footer katlakit-hf-wrap">';
		echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $this->footer_id, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div>';
	}

	/**
	 * Register template settings meta boxes.
	 *
	 * @return void
	 */
	public function register_meta_boxes(): void {
		add_meta_box(
			'katlakit-template-options',
			esc_html__( 'Header Footer Options', 'katlakit' ),
			[ $this, 'render_template_options_meta_box' ],
			self::POST_TYPE,
			'normal',
			'high'
		);

		add_meta_box(
			'katlakit-display-rules',
			esc_html__( 'Display Rules', 'katlakit' ),
			[ $this, 'render_display_rules_meta_box' ],
			self::POST_TYPE,
			'normal',
			'default'
		);

		remove_meta_box( 'postcustom', self::POST_TYPE, 'normal' );
		remove_meta_box( 'postcustom', self::POST_TYPE, 'advanced' );
	}

	/**
	 * Render the template options meta box.
	 *
	 * @param \WP_Post $post Current post object.
	 * @return void
	 */
	public function render_template_options_meta_box( \WP_Post $post ): void {
		$current_type = $this->get_template_type_value( $post->ID );

		wp_nonce_field( self::NONCE_ACTION, 'katlakit_template_nonce' );
		?>
		<div class="katlakit-hf-metabox">
			<p class="katlakit-hf-note">
				<?php esc_html_e( 'Choose where this Elementor template should be used inside the builder flow.', 'katlakit' ); ?>
			</p>
			<div class="katlakit-hf-field-grid">
				<div class="katlakit-hf-field">
					<label for="katlakit-template-type"><strong><?php esc_html_e( 'Type of Template', 'katlakit' ); ?></strong></label>
					<select id="katlakit-template-type" name="katlakit_template_type">
						<?php foreach ( $this->get_template_types() as $type_key => $type_label ) : ?>
							<option value="<?php echo esc_attr( $type_key ); ?>" <?php selected( $current_type, $type_key ); ?>>
								<?php echo esc_html( $type_label ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render the display rules meta box.
	 *
	 * @param \WP_Post $post Current post object.
	 * @return void
	 */
	public function render_display_rules_meta_box( \WP_Post $post ): void {
		$display_rules   = $this->normalize_rules( get_post_meta( $post->ID, self::META_DISPLAY_RULES, true ) );
		$exclusion_rules = $this->normalize_rules( get_post_meta( $post->ID, self::META_EXCLUSION_RULES, true ) );

		if ( empty( $display_rules ) ) {
			$display_rules = [ 'entire-site' ];
		}

		?>
		<div class="katlakit-hf-metabox">
			<p class="katlakit-hf-note">
				<?php esc_html_e( 'Templates appear only when a display rule matches the current request. Exclusion rules always win.', 'katlakit' ); ?>
			</p>

			<div class="katlakit-hf-rules-panel">
				<h4><?php esc_html_e( 'Display On', 'katlakit' ); ?></h4>
				<div class="katlakit-hf-rules-list">
					<?php foreach ( $display_rules as $rule ) : ?>
						<?php $this->render_rule_row( 'katlakit_display_rules[]', $rule ); ?>
					<?php endforeach; ?>
					<?php $this->render_rule_row( 'katlakit_display_rules[]', '', true ); ?>
				</div>
				<p>
					<button type="button" class="button katlakit-hf-add-rule"><?php esc_html_e( 'Add Display Rule', 'katlakit' ); ?></button>
				</p>
			</div>

			<div class="katlakit-hf-rules-panel">
				<h4><?php esc_html_e( 'Do Not Display On', 'katlakit' ); ?></h4>
				<div class="katlakit-hf-rules-list">
					<?php if ( ! empty( $exclusion_rules ) ) : ?>
						<?php foreach ( $exclusion_rules as $rule ) : ?>
							<?php $this->render_rule_row( 'katlakit_exclusion_rules[]', $rule ); ?>
						<?php endforeach; ?>
					<?php else : ?>
						<?php $this->render_rule_row( 'katlakit_exclusion_rules[]', '' ); ?>
					<?php endif; ?>
					<?php $this->render_rule_row( 'katlakit_exclusion_rules[]', '', true ); ?>
				</div>
				<p>
					<button type="button" class="button katlakit-hf-add-rule"><?php esc_html_e( 'Add Exclusion Rule', 'katlakit' ); ?></button>
				</p>
			</div>
		</div>
		<?php
	}

	/**
	 * Render a single rule row.
	 *
	 * @param string $field_name Input field name.
	 * @param string $selected   Selected rule.
	 * @return void
	 */
	private function render_rule_row( string $field_name, string $selected, bool $is_template = false ): void {
		$is_specific_target  = $this->is_specific_rule( $selected );
		$selected_rule_type  = $is_specific_target ? 'specific-target' : $selected;
		$specific_rule_label = $is_specific_target ? $this->get_specific_rule_label( $selected ) : '';
		?>
		<div class="katlakit-hf-rule-row<?php echo $is_template ? ' katlakit-hf-rule-template' : ''; ?>"<?php echo $is_template ? ' hidden' : ''; ?>>
			<input type="hidden" class="katlakit-hf-rule-value" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $selected ); ?>" <?php disabled( $is_template, true ); ?>>
			<div class="katlakit-hf-rule-fields">
				<?php $this->render_rule_select( $selected_rule_type, $is_template ); ?>
				<div class="katlakit-hf-specific-wrap<?php echo $is_specific_target ? '' : ' is-hidden'; ?>">
					<input type="text" class="regular-text katlakit-hf-specific-search" value="<?php echo esc_attr( $specific_rule_label ); ?>" placeholder="<?php echo esc_attr__( 'Search pages / post / categories', 'katlakit' ); ?>" autocomplete="off" <?php disabled( $is_template, true ); ?>>
					<div class="katlakit-hf-search-results" hidden></div>
				</div>
			</div>
			<button type="button" class="button-link-delete katlakit-hf-remove-rule"><?php esc_html_e( 'Remove', 'katlakit' ); ?></button>
		</div>
		<?php
	}

	/**
	 * Render a rule select control.
	 *
	 * @param string $selected   Selected rule.
	 * @param bool   $disabled   Whether the field is disabled.
	 * @return void
	 */
	private function render_rule_select( string $selected, bool $disabled = false ): void {
		?>
		<select class="katlakit-hf-rule-type" <?php disabled( $disabled, true ); ?>>
			<option value=""><?php esc_html_e( 'Select Rule', 'katlakit' ); ?></option>
			<?php foreach ( $this->get_available_rule_options() as $group ) : ?>
				<optgroup label="<?php echo esc_attr( $group['label'] ); ?>">
					<?php foreach ( $group['options'] as $rule_key => $rule_label ) : ?>
						<option value="<?php echo esc_attr( $rule_key ); ?>" <?php selected( $selected, $rule_key ); ?>>
							<?php echo esc_html( $rule_label ); ?>
						</option>
					<?php endforeach; ?>
				</optgroup>
			<?php endforeach; ?>
		</select>
		<?php
	}

	/**
	 * Save builder template settings.
	 *
	 * @param int $post_id Current post ID.
	 * @return void
	 */
	public function save_template_settings( int $post_id ): void {
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! isset( $_POST['katlakit_template_nonce'] ) ) {
			return;
		}

		$nonce = sanitize_text_field( wp_unslash( $_POST['katlakit_template_nonce'] ) );

		if ( ! wp_verify_nonce( $nonce, self::NONCE_ACTION ) ) {
			return;
		}

		$template_type = isset( $_POST['katlakit_template_type'] ) ? sanitize_key( wp_unslash( $_POST['katlakit_template_type'] ) ) : '';

		if ( ! $this->is_valid_template_type( $template_type ) ) {
			$template_type = 'header';
		}

		update_post_meta( $post_id, self::META_TEMPLATE_TYPE, $template_type );

		$display_rules   = isset( $_POST['katlakit_display_rules'] ) ? array_map( 'sanitize_text_field', wp_unslash( (array) $_POST['katlakit_display_rules'] ) ) : [];
		$exclusion_rules = isset( $_POST['katlakit_exclusion_rules'] ) ? array_map( 'sanitize_text_field', wp_unslash( (array) $_POST['katlakit_exclusion_rules'] ) ) : [];

		if ( empty( $display_rules ) ) {
			$display_rules = [ 'entire-site' ];
		}

		update_post_meta( $post_id, self::META_DISPLAY_RULES, $display_rules );
		update_post_meta( $post_id, self::META_EXCLUSION_RULES, $exclusion_rules );

		$this->sync_legacy_global_options( $post_id, $template_type, $display_rules, $exclusion_rules );
	}

	/**
	 * Register admin columns for the builder list table.
	 *
	 * @param array $columns Existing columns.
	 * @return array
	 */
	public function register_admin_columns( array $columns ): array {
		$updated_columns = [];

		foreach ( $columns as $column_key => $column_label ) {
			$updated_columns[ $column_key ] = $column_label;

			if ( 'title' === $column_key ) {
				$updated_columns['katlakit_template_type'] = esc_html__( 'Type', 'katlakit' );
				$updated_columns['katlakit_shortcode']     = esc_html__( 'Shortcode', 'katlakit' );
				$updated_columns['katlakit_display_rules'] = esc_html__( 'Display Rules', 'katlakit' );
			}
		}

		return $updated_columns;
	}

	/**
	 * Render builder admin columns.
	 *
	 * @param string $column_name Column name.
	 * @param int    $post_id     Post ID.
	 * @return void
	 */
	public function render_admin_column( string $column_name, int $post_id ): void {
		if ( 'katlakit_template_type' === $column_name ) {
			echo esc_html( $this->get_template_type_label( $this->get_template_type_value( $post_id ) ) );
			return;
		}

		if ( 'katlakit_shortcode' === $column_name ) {
			printf( '<code>[katlakit_template id="%d"]</code>', absint( $post_id ) );
			return;
		}

		if ( 'katlakit_display_rules' === $column_name ) {
			$display_rules = $this->normalize_rules( get_post_meta( $post_id, self::META_DISPLAY_RULES, true ) );

			if ( empty( $display_rules ) ) {
				echo esc_html__( 'Entire Website', 'katlakit' );
				return;
			}

			$labels = array_map( [ $this, 'get_rule_label' ], $display_rules );
			echo esc_html( implode( ', ', array_filter( $labels ) ) );
		}
	}

	/**
	 * Add state labels in the list table.
	 *
	 * @param array    $states Existing post states.
	 * @param \WP_Post $post   Current post.
	 * @return array
	 */
	public function add_template_state_labels( array $states, \WP_Post $post ): array {
		if ( self::POST_TYPE !== $post->post_type ) {
			return $states;
		}

		$template_type = $this->get_template_type_value( $post->ID );

		if ( $template_type ) {
			$states[] = $this->get_template_type_label( $template_type );
		}

		return $states;
	}

	/**
	 * Disable block editor for the builder post type.
	 *
	 * @param bool   $use_block_editor Whether block editor is enabled.
	 * @param string $post_type        Current post type.
	 * @return bool
	 */
	public function disable_block_editor( bool $use_block_editor, string $post_type ): bool {
		if ( self::POST_TYPE === $post_type ) {
			return false;
		}

		return $use_block_editor;
	}

	/**
	 * Update the title placeholder.
	 *
	 * @param string   $placeholder Existing placeholder.
	 * @param \WP_Post $post        Current post.
	 * @return string
	 */
	public function filter_title_placeholder( string $placeholder, \WP_Post $post ): string {
		if ( self::POST_TYPE === $post->post_type ) {
			return esc_html__( 'Add template title', 'katlakit' );
		}

		return $placeholder;
	}

	/**
	 * Handle the legacy "set template" admin action.
	 *
	 * @return void
	 */
	public function handle_set_template(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'Unauthorized.', 'katlakit' ) );
		}

		check_admin_referer( 'katlakit_set_template' );

		$type = isset( $_GET['type'] ) ? sanitize_key( wp_unslash( $_GET['type'] ) ) : '';
		$id   = isset( $_GET['id'] ) ? absint( wp_unslash( $_GET['id'] ) ) : 0;

		if ( in_array( $type, [ 'header', 'before_footer', 'footer' ], true ) && $id > 0 ) {
			update_option( 'katlakit_' . $type . '_template_id', $id, false );
			update_post_meta( $id, self::META_TEMPLATE_TYPE, $type );

			$display_rules = $this->normalize_rules( get_post_meta( $id, self::META_DISPLAY_RULES, true ) );

			if ( empty( $display_rules ) ) {
				update_post_meta( $id, self::META_DISPLAY_RULES, [ 'entire-site' ] );
			}
		}

		wp_safe_redirect( admin_url( 'edit.php?post_type=' . self::POST_TYPE ) );
		exit;
	}

	/**
	 * Return all templates.
	 *
	 * @return \WP_Post[]
	 */
	public static function get_all_templates(): array {
		return get_posts(
			[
				'post_type'      => self::POST_TYPE,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			]
		);
	}

	/**
	 * Get active header template ID.
	 *
	 * @return int|false
	 */
	public function get_header_id() {
		return $this->header_id;
	}

	/**
	 * Get active before footer template ID.
	 *
	 * @return int|false
	 */
	public function get_before_footer_id() {
		return $this->before_footer_id;
	}

	/**
	 * Get active footer template ID.
	 *
	 * @return int|false
	 */
	public function get_footer_id() {
		return $this->footer_id;
	}

	/**
	 * Find the first matching template for a given builder type.
	 *
	 * @param string $template_type Builder template type.
	 * @return int|false
	 */
	private function find_matching_template_id( string $template_type ) {
		$templates = get_posts(
			[
				'post_type'      => self::POST_TYPE,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'meta_key'       => self::META_TEMPLATE_TYPE, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				'meta_value'     => $template_type, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
				'orderby'        => 'date',
				'order'          => 'DESC',
			]
		);

		foreach ( $templates as $template ) {
			if ( $this->template_matches_current_request( $template->ID ) ) {
				return $template->ID;
			}
		}

		return false;
	}

	/**
	 * Determine whether the template should render on the current request.
	 *
	 * @param int $post_id Template post ID.
	 * @return bool
	 */
	private function template_matches_current_request( int $post_id ): bool {
		$display_rules   = $this->normalize_rules( get_post_meta( $post_id, self::META_DISPLAY_RULES, true ) );
		$exclusion_rules = $this->normalize_rules( get_post_meta( $post_id, self::META_EXCLUSION_RULES, true ) );

		if ( empty( $display_rules ) ) {
			$display_rules = [ 'entire-site' ];
		}

		$matches_display_rule = false;

		foreach ( $display_rules as $rule ) {
			if ( $this->rule_matches_current_request( $rule ) ) {
				$matches_display_rule = true;
				break;
			}
		}

		if ( ! $matches_display_rule ) {
			return false;
		}

		foreach ( $exclusion_rules as $rule ) {
			if ( $this->rule_matches_current_request( $rule ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Check whether a single rule matches the current request.
	 *
	 * @param string $rule Rule identifier.
	 * @return bool
	 */
	private function rule_matches_current_request( string $rule ): bool {
		if ( '' === $rule ) {
			return false;
		}

		$specific_rule = $this->parse_specific_rule( $rule );

		if ( ! empty( $specific_rule ) ) {
			if ( 'post' === $specific_rule['type'] ) {
				return is_singular() && get_queried_object_id() === $specific_rule['object_id'];
			}

			return $this->is_specific_term_rule_match( $specific_rule );
		}

		if ( 'entire-site' === $rule ) {
			return true;
		}

		if ( 'all-singular' === $rule ) {
			return is_singular();
		}

		if ( 'all-archives' === $rule ) {
			return is_archive();
		}

		if ( 'front-page' === $rule ) {
			return is_front_page();
		}

		if ( 'blog-page' === $rule ) {
			return is_home();
		}

		if ( 'search-page' === $rule ) {
			return is_search();
		}

		if ( '404-page' === $rule ) {
			return is_404();
		}

		if ( 0 === strpos( $rule, 'singular:' ) ) {
			return is_singular( substr( $rule, 9 ) );
		}

		if ( 0 === strpos( $rule, 'archive:' ) ) {
			$post_type = substr( $rule, 8 );

			if ( 'post' === $post_type ) {
				return is_home() || is_post_type_archive( 'post' );
			}

			return is_post_type_archive( $post_type );
		}

		if ( 0 === strpos( $rule, 'taxonomy:' ) ) {
			return $this->is_taxonomy_rule_match( substr( $rule, 9 ) );
		}

		return false;
	}

	/**
	 * Check a taxonomy archive rule.
	 *
	 * @param string $taxonomy Taxonomy slug.
	 * @return bool
	 */
	private function is_taxonomy_rule_match( string $taxonomy ): bool {
		if ( 'category' === $taxonomy ) {
			return is_category();
		}

		if ( 'post_tag' === $taxonomy ) {
			return is_tag();
		}

		return is_tax( $taxonomy );
	}

	/**
	 * Check a specific taxonomy term rule.
	 *
	 * @param array $specific_rule Parsed specific rule.
	 * @return bool
	 */
	private function is_specific_term_rule_match( array $specific_rule ): bool {
		if ( empty( $specific_rule['taxonomy'] ) ) {
			return false;
		}

		$taxonomy = $specific_rule['taxonomy'];
		$term_id  = $specific_rule['object_id'];

		if ( 'category' === $taxonomy ) {
			return is_category( $term_id );
		}

		if ( 'post_tag' === $taxonomy ) {
			return is_tag( $term_id );
		}

		return is_tax( $taxonomy, $term_id );
	}

	/**
	 * Return the available template types.
	 *
	 * @return array
	 */
	private function get_template_types(): array {
		return [
			'header'        => esc_html__( 'Header', 'katlakit' ),
			'before_footer' => esc_html__( 'Before Footer', 'katlakit' ),
			'footer'        => esc_html__( 'Footer', 'katlakit' ),
			'custom_block'  => esc_html__( 'Custom Block', 'katlakit' ),
		];
	}

	/**
	 * Return rule options grouped for the admin select UI.
	 *
	 * @return array
	 */
	private function get_available_rule_options(): array {
		$groups = [
			[
				'label'   => esc_html__( 'Specific Target', 'katlakit' ),
				'options' => [
					'specific-target' => esc_html__( 'Specific Pages / Posts / Taxonomies, etc.', 'katlakit' ),
				],
			],
			[
				'label'   => esc_html__( 'General', 'katlakit' ),
				'options' => [
					'entire-site' => esc_html__( 'Entire Website', 'katlakit' ),
					'all-singular' => esc_html__( 'All Singulars', 'katlakit' ),
					'all-archives' => esc_html__( 'All Archives', 'katlakit' ),
				],
			],
			[
				'label'   => esc_html__( 'Special Pages', 'katlakit' ),
				'options' => [
					'front-page' => esc_html__( 'Front Page', 'katlakit' ),
					'blog-page'  => esc_html__( 'Blog / Posts Page', 'katlakit' ),
					'search-page' => esc_html__( 'Search Results', 'katlakit' ),
					'404-page'   => esc_html__( '404 Page', 'katlakit' ),
				],
			],
		];

		$post_types = get_post_types(
			[
				'public' => true,
			],
			'objects'
		);

		foreach ( $post_types as $post_type => $post_type_object ) {
			if ( 'attachment' === $post_type ) {
				continue;
			}

			$group_options = [
				'singular:' . $post_type => sprintf(
					/* translators: %s: post type label. */
					esc_html__( 'All %s', 'katlakit' ),
					$post_type_object->labels->name
				),
			];

			if ( ! empty( $post_type_object->has_archive ) || 'post' === $post_type ) {
				$group_options[ 'archive:' . $post_type ] = sprintf(
					/* translators: %s: post type label. */
					esc_html__( 'All %s Archive', 'katlakit' ),
					$post_type_object->labels->name
				);
			}

			$taxonomies = get_object_taxonomies( $post_type, 'objects' );

			foreach ( $taxonomies as $taxonomy ) {
				if ( empty( $taxonomy->public ) || 'post_format' === $taxonomy->name ) {
					continue;
				}

				$taxonomy_label = ! empty( $taxonomy->labels->singular_name ) ? $taxonomy->labels->singular_name : $taxonomy->label;
				$group_options[ 'taxonomy:' . $taxonomy->name ] = sprintf(
					/* translators: %s: taxonomy label. */
					esc_html__( 'All %s Archive', 'katlakit' ),
					$taxonomy_label
				);
			}

			$groups[] = [
				'label'   => $post_type_object->labels->name,
				'options' => $group_options,
			];
		}

		return $groups;
	}

	/**
	 * Normalize a stored rules value into a clean string array.
	 *
	 * @param mixed $rules Stored rules.
	 * @return array
	 */
	private function normalize_rules( $rules ): array {
		if ( ! is_array( $rules ) ) {
			return [];
		}

		return array_values( array_filter( array_map( 'strval', $rules ) ) );
	}

	/**
	 * Sanitize submitted rules.
	 *
	 * @param mixed $rules Submitted rules.
	 * @return array
	 */
	private function sanitize_rules( $rules ): array {
		if ( ! is_array( $rules ) ) {
			return [];
		}

		$allowed_rules = [];

		foreach ( $this->get_available_rule_options() as $group ) {
			$allowed_rules = array_merge( $allowed_rules, array_keys( $group['options'] ) );
		}

		$sanitized = [];

		foreach ( $rules as $rule ) {
			$rule = sanitize_text_field( wp_unslash( $rule ) );

			if ( in_array( $rule, $allowed_rules, true ) && 'specific-target' !== $rule ) {
				$sanitized[] = $rule;
				continue;
			}

			if ( $this->is_specific_rule( $rule ) ) {
				$sanitized[] = $rule;
			}
		}

		return array_values( array_unique( $sanitized ) );
	}

	/**
	 * Get a rule label from its stored identifier.
	 *
	 * @param string $rule Rule identifier.
	 * @return string
	 */
	private function get_rule_label( string $rule ): string {
		if ( $this->is_specific_rule( $rule ) ) {
			return $this->get_specific_rule_label( $rule );
		}

		foreach ( $this->get_available_rule_options() as $group ) {
			if ( isset( $group['options'][ $rule ] ) ) {
				return $group['options'][ $rule ];
			}
		}

		return '';
	}

	/**
	 * Parse a specific target rule into structured data.
	 *
	 * @param string $rule Stored rule value.
	 * @return array
	 */
	private function parse_specific_rule( string $rule ): array {
		if ( 1 === preg_match( '/^specific:post:(\d+)$/', $rule, $matches ) ) {
			$post = get_post( (int) $matches[1] );

			if ( $post instanceof \WP_Post ) {
				return [
					'type'      => 'post',
					'object_id' => (int) $matches[1],
				];
			}
		}

		if ( 1 === preg_match( '/^specific:term:([A-Za-z0-9_-]+):(\d+)$/', $rule, $matches ) ) {
			$term = get_term( (int) $matches[2], $matches[1] );

			if ( $term instanceof \WP_Term ) {
				return [
					'type'      => 'term',
					'taxonomy'  => $matches[1],
					'object_id' => (int) $matches[2],
				];
			}
		}

		return [];
	}

	/**
	 * Check whether a stored rule is a valid specific target rule.
	 *
	 * @param string $rule Stored rule.
	 * @return bool
	 */
	private function is_specific_rule( string $rule ): bool {
		return ! empty( $this->parse_specific_rule( $rule ) );
	}

	/**
	 * Get a human label for a specific target rule.
	 *
	 * @param string $rule Stored rule value.
	 * @return string
	 */
	private function get_specific_rule_label( string $rule ): string {
		$specific_rule = $this->parse_specific_rule( $rule );

		if ( empty( $specific_rule ) ) {
			return '';
		}

		if ( 'post' === $specific_rule['type'] ) {
			$post = get_post( $specific_rule['object_id'] );

			if ( $post instanceof \WP_Post ) {
				$post_type_object = get_post_type_object( $post->post_type );
				$post_title       = '' !== $post->post_title ? $post->post_title : esc_html__( '(no title)', 'katlakit' );

				return sprintf(
					/* translators: 1: post title, 2: post type label. */
					esc_html__( '%1$s (%2$s)', 'katlakit' ),
					$post_title,
					$post_type_object ? $post_type_object->labels->singular_name : $post->post_type
				);
			}
		}

		$term = get_term( $specific_rule['object_id'], $specific_rule['taxonomy'] ?? '' );

		if ( $term instanceof \WP_Term ) {
			$taxonomy = get_taxonomy( $term->taxonomy );

			return sprintf(
				/* translators: 1: term name, 2: taxonomy label. */
				esc_html__( '%1$s (%2$s)', 'katlakit' ),
				$term->name,
				$taxonomy && ! empty( $taxonomy->labels->singular_name ) ? $taxonomy->labels->singular_name : $term->taxonomy
			);
		}

		return '';
	}

	/**
	 * Resolve the template type for a post.
	 *
	 * @param int $post_id Post ID.
	 * @return string
	 */
	private function get_template_type_value( int $post_id ): string {
		$template_type = get_post_meta( $post_id, self::META_TEMPLATE_TYPE, true );

		if ( is_string( $template_type ) && $this->is_valid_template_type( $template_type ) ) {
			return $template_type;
		}

		foreach ( [ 'header', 'before_footer', 'footer' ] as $legacy_type ) {
			if ( (int) get_option( 'katlakit_' . $legacy_type . '_template_id', 0 ) === $post_id ) {
				return $legacy_type;
			}
		}

		$query_type = isset( $_GET['template_type'] ) ? sanitize_key( wp_unslash( $_GET['template_type'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		if ( $this->is_valid_template_type( $query_type ) ) {
			return $query_type;
		}

		return 'header';
	}

	/**
	 * Validate a builder template type.
	 *
	 * @param string $template_type Builder template type.
	 * @return bool
	 */
	private function is_valid_template_type( string $template_type ): bool {
		return isset( $this->get_template_types()[ $template_type ] );
	}

	/**
	 * Get the human label for a template type.
	 *
	 * @param string $template_type Builder template type.
	 * @return string
	 */
	private function get_template_type_label( string $template_type ): string {
		$template_types = $this->get_template_types();

		return $template_types[ $template_type ] ?? esc_html__( 'Header', 'katlakit' );
	}



	/**
	 * Return a legacy globally assigned template ID.
	 *
	 * @param string $template_type Builder template type.
	 * @return int|false
	 */
	private function get_legacy_template_id( string $template_type ) {
		$template_id = (int) get_option( 'katlakit_' . $template_type . '_template_id', 0 );

		return $template_id > 0 ? $template_id : false;
	}

	/**
	 * Keep legacy global options in sync for backward compatibility.
	 *
	 * @param int    $post_id          Current template ID.
	 * @param string $template_type    Builder template type.
	 * @param array  $display_rules    Include rules.
	 * @param array  $exclusion_rules  Exclusion rules.
	 * @return void
	 */
	private function sync_legacy_global_options( int $post_id, string $template_type, array $display_rules, array $exclusion_rules ): void {
		$legacy_template_types = [ 'header', 'before_footer', 'footer' ];

		foreach ( $legacy_template_types as $legacy_type ) {
			$option_name = 'katlakit_' . $legacy_type . '_template_id';
			$current_id  = (int) get_option( $option_name, 0 );

			if ( $legacy_type !== $template_type && $current_id === $post_id ) {
				delete_option( $option_name );
			}
		}

		if ( ! in_array( $template_type, $legacy_template_types, true ) ) {
			return;
		}

		if ( 'publish' !== get_post_status( $post_id ) ) {
			return;
		}

		if ( $this->is_global_rule_set( $display_rules, $exclusion_rules ) ) {
			update_option( 'katlakit_' . $template_type . '_template_id', $post_id, false );
			return;
		}

		$option_name = 'katlakit_' . $template_type . '_template_id';
		$current_id  = (int) get_option( $option_name, 0 );

		if ( $current_id === $post_id ) {
			delete_option( $option_name );
		}
	}

	/**
	 * Determine whether a ruleset is a global site-wide match.
	 *
	 * @param array $display_rules   Include rules.
	 * @param array $exclusion_rules Exclusion rules.
	 * @return bool
	 */
	private function is_global_rule_set( array $display_rules, array $exclusion_rules ): bool {
		return in_array( 'entire-site', $display_rules, true ) && empty( $exclusion_rules );
	}
}
