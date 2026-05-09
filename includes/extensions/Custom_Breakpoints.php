<?php
/**
 * Custom Breakpoints Extension
 *
 * @package KatlaKit\Extensions
 */

namespace KatlaKit\Extensions;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Controls_Manager;
use Elementor\Element_Base;

class Custom_Breakpoints {

	public function init(): void {
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'register_controls' ], 10, 2 );
		add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'register_controls' ], 10, 2 );
		add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'register_controls' ], 10, 2 );
		add_action( 'elementor/frontend/section/before_render', [ $this, 'before_render' ] );
		add_action( 'elementor/frontend/container/before_render', [ $this, 'before_render' ] );
		add_action( 'elementor/frontend/column/before_render', [ $this, 'before_render' ] );
	}

	public function register_controls( Element_Base $element, array $args ): void {
		$element->start_controls_section(
			'katlakit_section_breakpoints',
			[
				'label' => esc_html__( 'KatlaKit Visibility', 'katlakit' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'katlakit_hide_desktop',
			[
				'label'        => esc_html__( 'Hide On Desktop', 'katlakit' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'hide-desktop',
				'prefix_class' => 'kk-',
			]
		);

		$element->add_control(
			'katlakit_hide_tablet',
			[
				'label'        => esc_html__( 'Hide On Tablet', 'katlakit' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'hide-tablet',
				'prefix_class' => 'kk-',
			]
		);

		$element->add_control(
			'katlakit_hide_mobile',
			[
				'label'        => esc_html__( 'Hide On Mobile', 'katlakit' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'hide-mobile',
				'prefix_class' => 'kk-',
			]
		);

		$element->end_controls_section();
	}

	public function before_render( Element_Base $element ): void {
		// Elementor already handles prefix_class automatically if we use it, 
		// but we can add inline styles or extra data attributes here if needed.
	}
}
