<?php
/**
 * Flip Box Widget
 *
 * @package KatlaKit\Widgets\Creative
 */

namespace KatlaKit\Widgets\Creative;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

class Flip_Box extends Widget_Base {

	public function get_name(): string      { return 'katlakit-flip-box'; }
	public function get_title(): string     { return esc_html__( 'Flip Box', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-flip-box'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'flip', 'box', 'card', '3d', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/flip-box-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/flip-box-render.php';
	}
}
