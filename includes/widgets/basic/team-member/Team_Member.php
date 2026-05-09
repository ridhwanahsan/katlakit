<?php
/**
 * Team Member Widget
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

class Team_Member extends Widget_Base {

	public function get_name(): string      { return 'katlakit-team-member'; }
	public function get_title(): string     { return esc_html__( 'Team Member', 'katlakit' ); }
	public function get_icon(): string      { return 'eicon-person'; }
	public function get_categories(): array { return [ 'katlakit-addons' ]; }
	public function get_keywords(): array   { return [ 'team', 'member', 'person', 'profile', 'katlakit' ]; }

	protected function register_controls(): void {
		require __DIR__ . '/team-member-controls.php';
	}

	protected function render(): void {
		require __DIR__ . '/team-member-render.php';
	}
}
