<?php
/**
 * Base Widget
 *
 * Extended Elementor Widget_Base providing shared controls and utilities
 * for all KatlaKit widgets.
 *
 * @package KatlaKit\Base
 */

namespace KatlaKit\Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Widget_Base
 */
abstract class Widget_Base extends \Elementor\Widget_Base {

	/**
	 * Register common section: Animation.
	 */
	protected function register_animation_section(): void {
		$this->start_controls_section(
			'section_animation',
			[
				'label' => esc_html__( 'Animation', 'katlakit' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'entrance_animation',
			[
				'label'              => esc_html__( 'Entrance Animation', 'katlakit' ),
				'type'               => \Elementor\Controls_Manager::ANIMATION,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'animation_duration',
			[
				'label'   => esc_html__( 'Duration', 'katlakit' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'slow'   => esc_html__( 'Slow', 'katlakit' ),
					''       => esc_html__( 'Normal', 'katlakit' ),
					'fast'   => esc_html__( 'Fast', 'katlakit' ),
				],
				'default' => '',
			]
		);

		$this->add_control(
			'animation_delay',
			[
				'label'              => esc_html__( 'Delay (ms)', 'katlakit' ),
				'type'               => \Elementor\Controls_Manager::NUMBER,
				'default'            => '',
				'min'                => 0,
				'max'                => 3000,
				'step'               => 100,
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register a standard box-shadow control group on a given selector.
	 *
	 * @param string $selector CSS selector.
	 * @param string $prefix   Control prefix.
	 */
	protected function register_box_shadow( string $selector, string $prefix = '' ): void {
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => $prefix . 'box_shadow',
				'selector' => $selector,
			]
		);
	}

	/**
	 * Register border group + border-radius on a given selector.
	 *
	 * @param string $selector CSS selector.
	 * @param string $prefix   Control prefix.
	 */
	protected function register_border_controls( string $selector, string $prefix = '' ): void {
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => $prefix . 'border',
				'selector' => $selector,
			]
		);

		$this->add_control(
			$prefix . 'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'katlakit' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	/**
	 * Helper: register a background colour + gradient group control.
	 *
	 * @param string $selector CSS selector.
	 * @param string $prefix   Control prefix.
	 */
	protected function register_background_controls( string $selector, string $prefix = '' ): void {
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => $prefix . 'background',
				'label'    => esc_html__( 'Background', 'katlakit' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => $selector,
			]
		);
	}

	/**
	 * Enqueue per-widget frontend style if file exists and is not empty.
	 *
	 * @param string $handle Widget CSS handle (without katlakit- prefix).
	 */
	protected function enqueue_widget_style( string $handle ): void {
		$slug = 'katlakit-' . $handle;
		
		$reflector = new \ReflectionClass( $this );
		$dir       = wp_normalize_path( dirname( $reflector->getFileName() ) );
		$rel_path  = str_replace( wp_normalize_path( KATLAKIT_PATH ), '', $dir );
		$url_dir   = trailingslashit( KATLAKIT_URL . $rel_path );

		$file = $dir . '/' . $handle . '.css';
		$url  = $url_dir . $handle . '.css';

		if ( ! wp_style_is( $slug, 'registered' ) && file_exists( $file ) && filesize( $file ) > 0 ) {
			wp_register_style( $slug, $url, [ 'katlakit-frontend' ], KATLAKIT_VERSION );
		}
		wp_enqueue_style( $slug );
	}

	/**
	 * Enqueue per-widget frontend script if file exists and is not empty.
	 *
	 * @param string $handle Widget JS handle (without katlakit- prefix).
	 * @param array  $deps   Script dependencies.
	 */
	protected function enqueue_widget_script( string $handle, array $deps = [ 'jquery' ] ): void {
		$slug = 'katlakit-' . $handle;
		
		$reflector = new \ReflectionClass( $this );
		$dir       = wp_normalize_path( dirname( $reflector->getFileName() ) );
		$rel_path  = str_replace( wp_normalize_path( KATLAKIT_PATH ), '', $dir );
		$url_dir   = trailingslashit( KATLAKIT_URL . $rel_path );

		$file = $dir . '/' . $handle . '.js';
		$url  = $url_dir . $handle . '.js';

		if ( ! wp_script_is( $slug, 'registered' ) && file_exists( $file ) && filesize( $file ) > 0 ) {
			wp_register_script( $slug, $url, $deps, KATLAKIT_VERSION, true );
		}
		wp_enqueue_script( $slug );
	}
}
