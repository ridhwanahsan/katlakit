<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Front Content
		$this->start_controls_section( 'section_front', [ 'label' => esc_html__( 'Front', 'katlakit' ) ] );
		$this->add_control( 'front_icon', [ 'label' => esc_html__( 'Icon', 'katlakit' ), 'type' => Controls_Manager::ICONS, 'default' => [ 'value' => 'fas fa-star', 'library' => 'fa-solid' ] ] );
		$this->add_control( 'front_title', [ 'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Front Side', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'front_desc', [ 'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'Hover me to flip.', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		// Back Content
		$this->start_controls_section( 'section_back', [ 'label' => esc_html__( 'Back', 'katlakit' ) ] );
		$this->add_control( 'back_title', [ 'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Back Side', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'back_desc', [ 'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'This is the back side content.', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_text', [ 'label' => esc_html__( 'Button Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Click Here', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_link', [ 'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		// Settings
		$this->start_controls_section( 'section_settings', [ 'label' => esc_html__( 'Settings', 'katlakit' ) ] );
		$this->add_responsive_control( 'height', [ 'label' => esc_html__( 'Height', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px', 'vh' ], 'range' => [ 'px' => [ 'min' => 100, 'max' => 800 ] ], 'default' => [ 'unit' => 'px', 'size' => 300 ], 'selectors' => [ '{{WRAPPER}} .kk-flip-box' => 'height: {{SIZE}}{{UNIT}};' ] ] );
		$this->add_control( 'flip_direction', [ 'label' => esc_html__( 'Flip Direction', 'katlakit' ), 'type' => Controls_Manager::SELECT, 'options' => [ 'right' => esc_html__( 'Right', 'katlakit' ), 'left' => esc_html__( 'Left', 'katlakit' ), 'up' => esc_html__( 'Up', 'katlakit' ), 'down' => esc_html__( 'Down', 'katlakit' ) ], 'default' => 'right' ] );
		$this->add_control( 'border_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-fb-front, {{WRAPPER}} .kk-fb-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Front Style
		$this->start_controls_section( 'style_front', [ 'label' => esc_html__( 'Front', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'front_bg', 'selector' => '{{WRAPPER}} .kk-fb-front' ] );
		$this->add_control( 'front_text_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-fb-front' => 'color: {{VALUE}};' ] ] );
		$this->end_controls_section();

		// Back Style
		$this->start_controls_section( 'style_back', [ 'label' => esc_html__( 'Back', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'back_bg', 'selector' => '{{WRAPPER}} .kk-fb-back' ] );
		$this->add_control( 'back_text_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-fb-back' => 'color: {{VALUE}};' ] ] );
		$this->end_controls_section();
