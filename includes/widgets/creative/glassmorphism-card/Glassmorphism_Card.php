<?php
/**
 * Glassmorphism Card Widget
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
use KatlaKit\Controls\Group_Control_Glass;

class Glassmorphism_Card extends Widget_Base {

	public function get_name(): string      { return 'katlakit-glassmorphism-card'; }
	public function get_title(): string     { return esc_html__( 'Glassmorphism Card', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-image-box'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'glass', 'card', 'box', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/glassmorphism-card-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/glassmorphism-card-render.php';
	}
}
