<?php
/**
 * Testimonial Widget
 *
 * @package KatlaKit\Widgets\Basic
 */

namespace KatlaKit\Widgets\Basic;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

class Testimonial extends Widget_Base {

	public function get_name(): string      { return 'katlakit-testimonial'; }
	public function get_title(): string     { return esc_html__( 'Testimonial', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-testimonial'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'testimonial', 'review', 'quote', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/testimonial-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/testimonial-render.php';
	}
}
