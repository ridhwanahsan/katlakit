<?php
/**
 * Call To Action Widget
 *
 * @package KatlaKit\Widgets\Marketing
 */

namespace KatlaKit\Widgets\Marketing;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

class Call_To_Action extends Widget_Base {

	public function get_name(): string      { return 'katlakit-call-to-action'; }
	public function get_title(): string     { return esc_html__( 'Call To Action', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-call-to-action'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'cta', 'call to action', 'button', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/call-to-action-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/call-to-action-render.php';
	}
}
