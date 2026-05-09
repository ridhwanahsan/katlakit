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
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'pricing', 'table', 'price', 'plan', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/pricing-table-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/pricing-table-render.php';
	}
}
