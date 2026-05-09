<?php
/**
 * Pricing Table Widget
 *
 * @package KatlaKit\Widgets\Basic
 */

namespace KatlaKit\Widgets\Basic;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

class Pricing_Table extends Widget_Base {

	public function get_name(): string      { return 'katlakit-pricing-table'; }
	public function get_title(): string     { return esc_html__( 'Pricing Table', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-price-table'; }
	public function get_categories(): array { return [ 'katlakit-basic' ]; }
	public function get_keywords(): array   { return [ 'pricing', 'table', 'price', 'plan', 'katlakit' ]; }

	protected function register_controls(): void {

		// Header Section
		$this->start_controls_section( 'section_header', [ 'label' => esc_html__( 'Header', 'katlakit' ) ] );
		$this->add_control( 'title', [ 'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Pro Plan', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'subtitle', [ 'label' => esc_html__( 'Subtitle', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Best for Professionals', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'is_popular', [ 'label' => esc_html__( 'Popular Ribbon', 'katlakit' ), 'type' => Controls_Manager::SWITCHER, 'default' => '' ] );
		$this->add_control( 'popular_text', [ 'label' => esc_html__( 'Ribbon Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Most Popular', 'katlakit' ), 'condition' => [ 'is_popular' => 'yes' ] ] );
		$this->end_controls_section();

		// Pricing Section
		$this->start_controls_section( 'section_pricing', [ 'label' => esc_html__( 'Pricing', 'katlakit' ) ] );
		$this->add_control( 'currency', [ 'label' => esc_html__( 'Currency Symbol', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => '$', 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'price', [ 'label' => esc_html__( 'Price', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => '99', 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'period', [ 'label' => esc_html__( 'Period', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => '/ month', 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'original_price', [ 'label' => esc_html__( 'Original Price', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'description' => esc_html__( 'Shows a strikethrough original price', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		// Features Section
		$this->start_controls_section( 'section_features', [ 'label' => esc_html__( 'Features', 'katlakit' ) ] );
		$repeater = new \Elementor\Repeater();
		$repeater->add_control( 'feature_text', [ 'label' => esc_html__( 'Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Included Feature', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$repeater->add_control( 'feature_icon', [ 'label' => esc_html__( 'Icon', 'katlakit' ), 'type' => Controls_Manager::ICONS, 'default' => [ 'value' => 'fas fa-check', 'library' => 'fa-solid' ] ] );
		$repeater->add_control( 'feature_color', [ 'label' => esc_html__( 'Icon Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} {{CURRENT_ITEM}} .kk-pt-feature-icon' => 'color: {{VALUE}};' ] ] );
		$repeater->add_control( 'feature_disabled', [ 'label' => esc_html__( 'Disabled / Excluded', 'katlakit' ), 'type' => Controls_Manager::SWITCHER ] );

		$this->add_control( 'features', [
			'label' => esc_html__( 'Features List', 'katlakit' ), 'type' => Controls_Manager::REPEATER,
			'fields' => $repeater->get_controls(),
			'default' => [
				[ 'feature_text' => esc_html__( '10 Projects', 'katlakit' ) ],
				[ 'feature_text' => esc_html__( 'Basic Support', 'katlakit' ) ],
				[ 'feature_text' => esc_html__( 'No Setup Fee', 'katlakit' ) ],
				[ 'feature_text' => esc_html__( 'Premium Features', 'katlakit' ), 'feature_disabled' => 'yes', 'feature_icon' => [ 'value' => 'fas fa-times', 'library' => 'fa-solid' ] ],
			],
			'title_field' => '{{{ feature_text }}}',
		] );
		$this->end_controls_section();

		// Footer Section (Button)
		$this->start_controls_section( 'section_footer', [ 'label' => esc_html__( 'Button', 'katlakit' ) ] );
		$this->add_control( 'button_text', [ 'label' => esc_html__( 'Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Choose Plan', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_link', [ 'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#' ], 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'additional_info', [ 'label' => esc_html__( 'Additional Info', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'No credit card required', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		// Styles...
		// Header Style
		$this->start_controls_section( 'style_header', [ 'label' => esc_html__( 'Header', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'header_bg_color', [ 'label' => esc_html__( 'Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-header' => 'background-color: {{VALUE}};' ] ] );
		$this->add_control( 'title_color', [ 'label' => esc_html__( 'Title Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-title' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .kk-pt-title' ] );
		$this->add_control( 'subtitle_color', [ 'label' => esc_html__( 'Subtitle Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-subtitle' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'subtitle_typography', 'selector' => '{{WRAPPER}} .kk-pt-subtitle' ] );
		$this->end_controls_section();

		// Pricing Style
		$this->start_controls_section( 'style_pricing', [ 'label' => esc_html__( 'Pricing', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'pricing_bg_color', [ 'label' => esc_html__( 'Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-pricing' => 'background-color: {{VALUE}};' ] ] );
		$this->add_control( 'price_color', [ 'label' => esc_html__( 'Price Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-price' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'price_typography', 'selector' => '{{WRAPPER}} .kk-pt-price' ] );
		$this->add_control( 'currency_color', [ 'label' => esc_html__( 'Currency Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-currency' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'currency_typography', 'selector' => '{{WRAPPER}} .kk-pt-currency' ] );
		$this->add_control( 'period_color', [ 'label' => esc_html__( 'Period Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-period' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'period_typography', 'selector' => '{{WRAPPER}} .kk-pt-period' ] );
		$this->add_control( 'original_price_color', [ 'label' => esc_html__( 'Original Price Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-original-price' => 'color: {{VALUE}};' ] ] );
		$this->end_controls_section();

		// Features Style
		$this->start_controls_section( 'style_features', [ 'label' => esc_html__( 'Features', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'features_bg_color', [ 'label' => esc_html__( 'Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-features' => 'background-color: {{VALUE}};' ] ] );
		$this->add_control( 'feature_text_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-feature-text' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'feature_typography', 'selector' => '{{WRAPPER}} .kk-pt-feature-text' ] );
		$this->add_control( 'feature_icon_color', [ 'label' => esc_html__( 'Default Icon Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-feature-icon' => 'color: {{VALUE}};' ] ] );
		$this->add_control( 'feature_divider_color', [ 'label' => esc_html__( 'Divider Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-feature' => 'border-bottom-color: {{VALUE}};' ] ] );
		$this->add_control( 'feature_disabled_color', [ 'label' => esc_html__( 'Disabled Item Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => '#cbd5e1', 'selectors' => [ '{{WRAPPER}} .kk-pt-feature.kk-disabled' => 'color: {{VALUE}};', '{{WRAPPER}} .kk-pt-feature.kk-disabled .kk-pt-feature-text' => 'color: {{VALUE}}; text-decoration: line-through;' ] ] );
		$this->end_controls_section();

		// Ribbon Style
		$this->start_controls_section( 'style_ribbon', [ 'label' => esc_html__( 'Ribbon', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => [ 'is_popular' => 'yes' ] ] );
		$this->add_control( 'ribbon_bg_color', [ 'label' => esc_html__( 'Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-ribbon' => 'background-color: {{VALUE}};' ] ] );
		$this->add_control( 'ribbon_text_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-ribbon' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'ribbon_typography', 'selector' => '{{WRAPPER}} .kk-pt-ribbon' ] );
		$this->end_controls_section();

		// Button Style
		$this->start_controls_section( 'style_button', [ 'label' => esc_html__( 'Button', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'button_typography', 'selector' => '{{WRAPPER}} .kk-pt-button' ] );
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab( 'tab_button_normal', [ 'label' => esc_html__( 'Normal', 'katlakit' ) ] );
		$this->add_control( 'button_text_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-button' => 'color: {{VALUE}};' ] ] );
		$this->add_control( 'button_bg_color', [ 'label' => esc_html__( 'Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-button' => 'background-color: {{VALUE}};' ] ] );
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_button_hover', [ 'label' => esc_html__( 'Hover', 'katlakit' ) ] );
		$this->add_control( 'button_hover_text_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-button:hover' => 'color: {{VALUE}};' ] ] );
		$this->add_control( 'button_hover_bg_color', [ 'label' => esc_html__( 'Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-pt-button:hover' => 'background-color: {{VALUE}};' ] ] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control( 'button_border_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-pt-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'info_color', [ 'label' => esc_html__( 'Info Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .kk-pt-info' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'info_typography', 'selector' => '{{WRAPPER}} .kk-pt-info' ] );
		$this->end_controls_section();

		// Box Style
		$this->start_controls_section( 'style_box', [ 'label' => esc_html__( 'Box', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'box_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-pricing-table' ] );
		$this->add_control( 'box_border_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-pricing-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'box_shadow', 'selector' => '{{WRAPPER}} .kk-pricing-table' ] );
		$this->end_controls_section();

		$this->register_animation_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		?>
		<div class="kk-pricing-table">
			<?php if ( 'yes' === $settings['is_popular'] && ! empty( $settings['popular_text'] ) ) : ?>
				<div class="kk-pt-ribbon"><?php echo esc_html( $settings['popular_text'] ); ?></div>
			<?php endif; ?>

			<div class="kk-pt-header">
				<?php if ( ! empty( $settings['title'] ) ) : ?><h3 class="kk-pt-title"><?php echo esc_html( $settings['title'] ); ?></h3><?php endif; ?>
				<?php if ( ! empty( $settings['subtitle'] ) ) : ?><p class="kk-pt-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></p><?php endif; ?>
			</div>

			<div class="kk-pt-pricing">
				<?php if ( ! empty( $settings['currency'] ) ) : ?><span class="kk-pt-currency"><?php echo esc_html( $settings['currency'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $settings['price'] ) ) : ?><span class="kk-pt-price"><?php echo esc_html( $settings['price'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $settings['period'] ) ) : ?><span class="kk-pt-period"><?php echo esc_html( $settings['period'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $settings['original_price'] ) ) : ?><div class="kk-pt-original-price"><s><?php echo esc_html( $settings['original_price'] ); ?></s></div><?php endif; ?>
			</div>

			<?php if ( ! empty( $settings['features'] ) ) : ?>
				<ul class="kk-pt-features">
					<?php foreach ( $settings['features'] as $index => $item ) : 
						$repeater_class = $item['feature_disabled'] === 'yes' ? ' kk-disabled' : '';
						?>
						<li class="kk-pt-feature elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?><?php echo esc_attr( $repeater_class ); ?>">
							<?php if ( ! empty( $item['feature_icon']['value'] ) ) : ?>
								<span class="kk-pt-feature-icon"><?php \Elementor\Icons_Manager::render_icon( $item['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
							<?php endif; ?>
							<span class="kk-pt-feature-text"><?php echo wp_kses_post( $item['feature_text'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<div class="kk-pt-footer">
				<?php if ( ! empty( $settings['button_text'] ) ) : 
					$url = ! empty( $settings['button_link']['url'] ) ? esc_url( $settings['button_link']['url'] ) : '#';
					$target = ! empty( $settings['button_link']['is_external'] );
					$nofollow = ! empty( $settings['button_link']['nofollow'] );
					?>
					<a href="<?php echo esc_url( $url ); ?>" class="kk-pt-button"<?php echo $target ? ' target="_blank"' : ''; ?><?php echo $nofollow ? ' rel="nofollow"' : ''; ?>><?php echo esc_html( $settings['button_text'] ); ?></a>
				<?php endif; ?>
				<?php if ( ! empty( $settings['additional_info'] ) ) : ?>
					<div class="kk-pt-info"><?php echo wp_kses_post( $settings['additional_info'] ); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
