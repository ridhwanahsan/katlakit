<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Content
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Content', 'katlakit' ) ] );

		$this->add_control( 'image', [
			'label' => esc_html__( 'Image', 'katlakit' ), 'type' => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ], 'dynamic' => [ 'active' => true ],
		] );
		$this->add_group_control( Group_Control_Image_Size::get_type(), [ 'name' => 'image', 'default' => 'large' ] );

		$this->add_control( 'title', [
			'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Hover Card', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'description', [
			'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Hover over this image to reveal the hidden content with smooth animation.', 'katlakit' ),
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'link', [
			'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'hover_effect', [
			'label' => esc_html__( 'Hover Effect', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [
				'fade' => esc_html__( 'Fade In', 'katlakit' ),
				'slide-up' => esc_html__( 'Slide Up', 'katlakit' ),
				'zoom-in' => esc_html__( 'Zoom In', 'katlakit' ),
			],
			'default' => 'slide-up',
		] );

		$this->end_controls_section();

		// Style: Card
		$this->start_controls_section( 'style_card', [ 'label' => esc_html__( 'Card', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_responsive_control( 'height', [ 'label' => esc_html__( 'Height', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px', 'vh' ], 'range' => [ 'px' => [ 'min' => 100, 'max' => 800 ] ], 'default' => [ 'unit' => 'px', 'size' => 350 ], 'selectors' => [ '{{WRAPPER}} .kk-image-hover-card' => 'height: {{SIZE}}{{UNIT}};' ] ] );
		$this->add_control( 'overlay_color', [ 'label' => esc_html__( 'Overlay Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => 'rgba(0,0,0,0.6)', 'selectors' => [ '{{WRAPPER}} .kk-ihc-overlay' => 'background-color: {{VALUE}};' ] ] );
		$this->add_control( 'border_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-image-hover-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Style: Content
		$this->start_controls_section( 'style_content', [ 'label' => esc_html__( 'Content', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_responsive_control( 'content_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-ihc-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'title_color', [ 'label' => esc_html__( 'Title Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => '#ffffff', 'selectors' => [ '{{WRAPPER}} .kk-ihc-title' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .kk-ihc-title' ] );
		$this->add_control( 'desc_color', [ 'label' => esc_html__( 'Description Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'default' => '#dddddd', 'selectors' => [ '{{WRAPPER}} .kk-ihc-desc' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .kk-ihc-desc' ] );
		$this->end_controls_section();
