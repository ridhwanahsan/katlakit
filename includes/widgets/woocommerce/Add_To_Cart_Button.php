<?php
/**
 * Add To Cart Button Widget (WooCommerce)
 *
 * @package KatlaKit\Widgets\WooCommerce
 */

namespace KatlaKit\Widgets\WooCommerce;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

class Add_To_Cart_Button extends Widget_Base {

	public function get_name(): string      { return 'katlakit-add-to-cart-button'; }
	public function get_title(): string     { return esc_html__( 'Add To Cart Button', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-button'; }
	public function get_categories(): array { return [ 'katlakit-woocommerce' ]; }
	public function get_keywords(): array   { return [ 'woocommerce', 'cart', 'button', 'add to cart', 'katlakit' ]; }

	protected function register_controls(): void {

		$this->start_controls_section( 'section_product', [ 'label' => esc_html__( 'Product', 'katlakit' ) ] );

		$this->add_control( 'product_id', [
			'label' => esc_html__( 'Product ID', 'katlakit' ), 'type' => Controls_Manager::NUMBER,
			'description' => esc_html__( 'Leave empty to use current global product.', 'katlakit' ),
		] );

		$this->add_control( 'show_quantity', [
			'label' => esc_html__( 'Show Quantity', 'katlakit' ), 'type' => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_responsive_control( 'align', [
			'label' => esc_html__( 'Alignment', 'katlakit' ), 'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left'   => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
				'justify'=> [ 'title' => esc_html__( 'Justify', 'katlakit' ),'icon' => 'eicon-text-align-justify' ],
			],
			'default'   => 'left',
			'selectors' => [ 
				'{{WRAPPER}} .kk-atc-wrap' => 'text-align: {{VALUE}};',
				'{{WRAPPER}} .kk-atc-wrap form.cart' => 'justify-content: {{VALUE}};'
			],
		] );

		$this->end_controls_section();

		// Button Style
		$this->start_controls_section( 'style_button', [ 'label' => esc_html__( 'Button', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .single_add_to_cart_button' ] );
		$this->add_responsive_control( 'btn_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .single_add_to_cart_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		
		$this->start_controls_tabs( 'tabs_btn' );
		$this->start_controls_tab( 'tab_btn_normal', [ 'label' => esc_html__( 'Normal', 'katlakit' ) ] );
		$this->add_control( 'btn_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .single_add_to_cart_button' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .single_add_to_cart_button' ] );
		$this->end_controls_tab();
		
		$this->start_controls_tab( 'tab_btn_hover', [ 'label' => esc_html__( 'Hover', 'katlakit' ) ] );
		$this->add_control( 'btn_hover_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .single_add_to_cart_button:hover' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_hover_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .single_add_to_cart_button:hover' ] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control( 'btn_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .single_add_to_cart_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Quantity Style
		$this->start_controls_section( 'style_qty', [ 'label' => esc_html__( 'Quantity', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => [ 'show_quantity' => 'yes' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'qty_typography', 'selector' => '{{WRAPPER}} .quantity input.qty' ] );
		$this->add_control( 'qty_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .quantity input.qty' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'qty_bg', 'types' => [ 'classic' ], 'selector' => '{{WRAPPER}} .quantity input.qty' ] );
		$this->add_group_control( Group_Control_Border::get_type(), [ 'name' => 'qty_border', 'selector' => '{{WRAPPER}} .quantity input.qty' ] );
		$this->add_control( 'qty_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .quantity input.qty' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_responsive_control( 'qty_width', [ 'label' => esc_html__( 'Width', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px' ], 'selectors' => [ '{{WRAPPER}} .quantity input.qty' => 'width: {{SIZE}}{{UNIT}};' ] ] );
		$this->end_controls_section();
	}

	protected function render(): void {
		if ( ! class_exists( 'WooCommerce' ) ) {
			echo '<div class="kk-error">WooCommerce is not active.</div>';
			return;
		}

		$settings = $this->get_settings_for_display();
		global $product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		$product_id = ! empty( $settings['product_id'] ) ? absint( $settings['product_id'] ) : get_the_ID();
		$_product = wc_get_product( $product_id );

		if ( ! $_product ) {
			echo '<div class="kk-error">Product not found.</div>';
			return;
		}

		// Save current global product and set up new one.
		$original_product = $product;
		$product = $_product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		$show_qty = 'yes' === $settings['show_quantity'];
		?>
		<div class="kk-atc-wrap" style="width: 100%;">
			<style>
				.kk-atc-wrap form.cart { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
				<?php if ( ! $show_qty ) : ?>
					.kk-atc-wrap .quantity { display: none !important; }
				<?php endif; ?>
				<?php if ( 'justify' === $settings['align'] ) : ?>
					.kk-atc-wrap .single_add_to_cart_button { flex: 1; text-align: center; }
				<?php endif; ?>
			</style>
			<?php woocommerce_template_single_add_to_cart(); ?>
		</div>
		<?php

		// Restore original global product.
		$product = $original_product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	}
}
