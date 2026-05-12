<?php
/**
 * Core Plugin Singleton
 *
 * @package KatlaKit
 */

namespace KatlaKit;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Plugin
 *
 * Main singleton that bootstraps all KatlaKit subsystems.
 */
final class Plugin {

	/** @var Plugin|null Singleton instance. */
	private static $instance = null;

	/** @var array Merged plugin settings. */
	private $settings = [];

	/**
	 * Get or create the singleton instance.
	 *
	 * @return Plugin
	 */
	public static function instance(): Plugin {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Private constructor – use ::instance(). */
	private function __construct() {
		$this->load_settings();
		$this->register_hooks();
	}

	/** Prevent cloning. */
	private function __clone() {}

	/** Prevent unserialization. */
	public function __wakeup() {
		throw new \Exception( 'Cannot unserialize a singleton.' );
	}

	// ── Settings ──────────────────────────────────────────────────────────────

	/** Load and merge saved settings with defaults. */
	private function load_settings(): void {
		$saved          = get_option( 'katlakit_settings', [] );
		$defaults       = require KATLAKIT_INC_PATH . 'config/settings.php';
		$this->settings = wp_parse_args( $saved, $defaults );
	}

	/**
	 * Get a single setting value.
	 *
	 * @param  string $key     Setting key.
	 * @param  mixed  $default Fallback value.
	 * @return mixed
	 */
	public function get_setting( string $key, $default = '' ) {
		return isset( $this->settings[ $key ] ) ? $this->settings[ $key ] : $default;
	}

	/**
	 * Return all settings.
	 *
	 * @return array
	 */
	public function get_settings(): array {
		return $this->settings;
	}

	// ── Hooks ─────────────────────────────────────────────────────────────────

	/** Register WordPress & Elementor hooks. */
	private function register_hooks(): void {
		// Register widget categories.
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_categories' ] );

		// Init widget manager.
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register custom controls.
		add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );

		// Init extensions.
		add_action( 'elementor/init', [ $this, 'init_extensions' ] );

		// Asset helper.
		new Helpers\Assets();

		// Header / Footer builder module.
		add_action( 'init', [ $this, 'init_header_footer' ], 5 );
	}

	// ── Widget Categories ─────────────────────────────────────────────────────

	/**
	 * Register custom Elementor widget categories.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Elementor manager.
	 */
	public function register_widget_categories( $elements_manager ): void {
		$elements_manager->add_category( 'katlakit-addons', [
			'title' => esc_html__( 'KatlaKit Addons', 'katlakit' ),
			'icon'  => 'eicon-plug',
		] );
	}

	// ── Widgets ───────────────────────────────────────────────────────────────

	/**
	 * Delegate widget registration to the Widget_Manager.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor manager.
	 */
	public function register_widgets( $widgets_manager ): void {
		$manager = new Widgets\Widget_Manager( $this->settings );
		$manager->register( $widgets_manager );
	}

	// ── Controls ──────────────────────────────────────────────────────────────

	/**
	 * Register custom Elementor controls and group controls.
	 *
	 * @param \Elementor\Controls_Manager $controls_manager Elementor manager.
	 */
	public function register_controls( $controls_manager ): void {
		$controls_manager->add_group_control( Controls\Group_Control_Glass::get_type(), new Controls\Group_Control_Glass() );
	}

	// ── Extensions ────────────────────────────────────────────────────────────

	/** Initialise enabled extensions. */
	public function init_extensions(): void {
		$ext_manager = new Extensions\Extension_Manager( $this->settings );
		$ext_manager->init();
	}

	// ── Header / Footer ───────────────────────────────────────────────────────

	/**
	 * Boot the Header/Footer builder module.
	 */
	public function init_header_footer(): void {
		Modules\Header_Footer::instance();
	}
}
