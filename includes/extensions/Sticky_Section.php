<?php
/**
 * Sticky Section Extension
 *
 * @package KatlaKit\Extensions
 */

namespace KatlaKit\Extensions;

if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Controls_Manager;
use Elementor\Element_Base;

class Sticky_Section {

	public function init(): void {
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'register_controls' ], 10, 2 );
		add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'register_controls' ], 10, 2 );
		add_action( 'elementor/frontend/section/before_render', [ $this, 'before_render' ] );
		add_action( 'elementor/frontend/container/before_render', [ $this, 'before_render' ] );
	}

	public function register_controls( Element_Base $element, array $args ): void {
		$element->start_controls_section(
			'katlakit_section_sticky',
			[
				'label' => esc_html__( 'KatlaKit Sticky', 'katlakit' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'katlakit_sticky',
			[
				'label'        => esc_html__( 'Sticky', 'katlakit' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					''       => esc_html__( 'None', 'katlakit' ),
					'top'    => esc_html__( 'Top', 'katlakit' ),
					'bottom' => esc_html__( 'Bottom', 'katlakit' ),
				],
				'default'      => '',
				'prefix_class' => 'kk-sticky-',
			]
		);

		$element->add_control(
			'katlakit_sticky_offset',
			[
				'label'     => esc_html__( 'Sticky Offset', 'katlakit' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'min'       => 0,
				'max'       => 500,
				'condition' => [
					'katlakit_sticky!' => '',
				],
				'selectors' => [
					'{{WRAPPER}}.kk-sticky-top'    => 'position: sticky; top: {{VALUE}}px; z-index: 99;',
					'{{WRAPPER}}.kk-sticky-bottom' => 'position: sticky; bottom: {{VALUE}}px; z-index: 99;',
				],
			]
		);

		$element->end_controls_section();
	}

	public function before_render( Element_Base $element ): void {
		$settings = $element->get_settings_for_display();

		if ( ! empty( $settings['katlakit_sticky'] ) ) {
			$element->add_render_attribute( '_wrapper', 'class', 'kk-sticky-enabled' );
		}
	}
}
