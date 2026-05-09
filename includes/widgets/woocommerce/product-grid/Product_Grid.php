<?php
/**
 * Product Grid Widget (WooCommerce)
 *
 * @package KatlaKit\Widgets\WooCommerce
 */

namespace KatlaKit\Widgets\WooCommerce;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

class Product_Grid extends Widget_Base {

	public function get_name(): string      { return 'katlakit-product-grid'; }
	public function get_title(): string     { return esc_html__( 'Product Grid', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-products'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'woocommerce', 'product', 'grid', 'store', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/product-grid-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/product-grid-render.php';
	}
}
