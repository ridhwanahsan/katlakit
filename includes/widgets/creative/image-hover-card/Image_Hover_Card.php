<?php
/**
 * Image Hover Card Widget
 *
 * @package KatlaKit\Widgets\Creative
 */

namespace KatlaKit\Widgets\Creative;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use KatlaKit\Base\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Image_Hover_Card extends Widget_Base {

	public function get_name(): string      { return 'katlakit-image-hover-card'; }
	public function get_title(): string     { return esc_html__( 'Image Hover Card', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-image-rollover'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'image', 'hover', 'card', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/image-hover-card-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/image-hover-card-render.php';
	}
}
