<?php
/**
 * Countdown Timer Widget
 *
 * @package KatlaKit\Widgets\Marketing
 */

namespace KatlaKit\Widgets\Marketing;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

class Countdown_Timer extends Widget_Base {

	public function get_name(): string      { return 'katlakit-countdown'; }
	public function get_title(): string     { return esc_html__( 'Countdown Timer', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-countdown'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'countdown', 'timer', 'urgency', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/countdown-timer-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/countdown-timer-render.php';
	}
}
