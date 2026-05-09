<?php
/**
 * Glassmorphism Group Control
 *
 * @package KatlaKit\Controls
 */

namespace KatlaKit\Controls;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;

class Group_Control_Glass extends Group_Control_Base {

	protected static $fields;

	public static function get_type() {
		return 'katlakit-glass';
	}

	protected function init_fields() {
		$fields = [];

		$fields['blur'] = [
			'label' => esc_html__( 'Backdrop Blur', 'katlakit' ),
			'type' => Controls_Manager::SLIDER,
			'range' => [ 'px' => [ 'min' => 0, 'max' => 50, 'step' => 1 ] ],
			'selectors' => [
				'{{SELECTOR}}' => 'backdrop-filter: blur({{SIZE}}{{UNIT}}); -webkit-backdrop-filter: blur({{SIZE}}{{UNIT}});',
			],
		];

		$fields['bg_color'] = [
			'label' => esc_html__( 'Background Color', 'katlakit' ),
			'type' => Controls_Manager::COLOR,
			'default' => 'rgba(255, 255, 255, 0.1)',
			'selectors' => [
				'{{SELECTOR}}' => 'background-color: {{VALUE}};',
			],
		];

		$fields['border_color'] = [
			'label' => esc_html__( 'Border Color', 'katlakit' ),
			'type' => Controls_Manager::COLOR,
			'default' => 'rgba(255, 255, 255, 0.2)',
			'selectors' => [
				'{{SELECTOR}}' => 'border: 1px solid {{VALUE}};',
			],
		];

		return $fields;
	}

	protected function get_default_options() {
		return [
			'popover' => [
				'starter_name' => 'glass_popover',
				'starter_title' => esc_html__( 'Glassmorphism', 'katlakit' ),
				'settings' => [
					'render_type' => 'ui',
				],
			],
		];
	}
}
