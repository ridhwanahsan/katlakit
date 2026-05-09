<?php
/**
 * Dual Button Widget
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

class Dual_Button extends Widget_Base {

	public function get_name(): string      { return 'katlakit-dual-button'; }
	public function get_title(): string     { return esc_html__( 'Dual Button', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-button'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'dual', 'button', 'btn', 'cta', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/dual-button-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/dual-button-render.php';
	}
}
