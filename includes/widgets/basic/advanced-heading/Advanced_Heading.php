<?php
/**
 * Advanced Heading Widget
 *
 * @package KatlaKit\Widgets\Basic
 */

namespace KatlaKit\Widgets\Basic;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

/**
 * Class Advanced_Heading
 */
class Advanced_Heading extends Widget_Base {

	public function get_name(): string        { return 'katlakit-advanced-heading'; }
	public function get_title(): string       { return esc_html__( 'Advanced Heading', 'katlakit' ); }
	public function get_icon(): string        { return 'eicon-heading'; }
	public function get_categories(): array   { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array     { return [ 'heading', 'title', 'text', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/advanced-heading-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/advanced-heading-render.php';
	}
}
