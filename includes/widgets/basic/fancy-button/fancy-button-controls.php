<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Button', 'katlakit' ) ] );

		$this->add_control( 'button_text', [
			'label'       => esc_html__( 'Text', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Get Started', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'button_link', [
			'label'   => esc_html__( 'Link', 'katlakit' ),
			'type'    => Controls_Manager::URL,
			'default' => [ 'url' => '#' ],
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'button_style', [
			'label'   => esc_html__( 'Style', 'katlakit' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'filled'   => esc_html__( 'Filled', 'katlakit' ),
				'outline'  => esc_html__( 'Outline', 'katlakit' ),
				'gradient' => esc_html__( 'Gradient', 'katlakit' ),
				'ghost'    => esc_html__( 'Ghost', 'katlakit' ),
			],
			'default' => 'filled',
		] );

		$this->add_control( 'icon', [ 'label' => esc_html__( 'Icon', 'katlakit' ), 'type' => Controls_Manager::ICONS ] );

		$this->add_control( 'icon_position', [
			'label'     => esc_html__( 'Icon Position', 'katlakit' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [ 'before' => esc_html__( 'Before', 'katlakit' ), 'after' => esc_html__( 'After', 'katlakit' ) ],
			'default'   => 'after',
			'condition' => [ 'icon[value]!' => '' ],
		] );

		$this->add_responsive_control( 'button_align', [
			'label'     => esc_html__( 'Alignment', 'katlakit' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'left',
			'selectors' => [ '{{WRAPPER}} .kk-btn-wrap' => 'text-align: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// Style.
		$this->start_controls_section( 'style_button', [ 'label' => esc_html__( 'Button', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );

		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .kk-fancy-btn' ] );

		$this->add_responsive_control( 'btn_padding', [
			'label'      => esc_html__( 'Padding', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'default'    => [ 'top' => '14', 'right' => '32', 'bottom' => '14', 'left' => '32', 'unit' => 'px', 'isLinked' => false ],
			'selectors'  => [ '{{WRAPPER}} .kk-fancy-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->start_controls_tabs( 'btn_tabs' );
		$this->start_controls_tab( 'btn_normal', [ 'label' => esc_html__( 'Normal', 'katlakit' ) ] );

		$this->add_control( 'btn_text_color', [
			'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR,
			'default' => '#ffffff', 'selectors' => [ '{{WRAPPER}} .kk-fancy-btn' => 'color: {{VALUE}};' ],
		] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-fancy-btn' ] );

		$this->end_controls_tab();
		$this->start_controls_tab( 'btn_hover', [ 'label' => esc_html__( 'Hover', 'katlakit' ) ] );

		$this->add_control( 'btn_hover_color', [
			'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-fancy-btn:hover' => 'color: {{VALUE}};' ],
		] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_hover_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-fancy-btn:hover' ] );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control( 'btn_border_radius', [
			'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ], 'separator' => 'before',
			'default' => [ 'top' => '8', 'right' => '8', 'bottom' => '8', 'left' => '8', 'unit' => 'px', 'isLinked' => true ],
			'selectors' => [ '{{WRAPPER}} .kk-fancy-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'btn_shadow', 'selector' => '{{WRAPPER}} .kk-fancy-btn' ] );

		$this->end_controls_section();
		$this->register_animation_section();
