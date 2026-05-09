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
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'woocommerce', 'cart', 'button', 'add to cart', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/add-to-cart-button-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/add-to-cart-button-render.php';
	}
}
