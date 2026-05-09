<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Content
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Content', 'katlakit' ) ] );

		$this->add_control( 'title', [
			'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Ready to boost your sales?', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'description', [
			'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Join thousands of satisfied customers who are already using our product to increase their revenue.', 'katlakit' ),
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'button_text', [
			'label' => esc_html__( 'Button Text', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Get Started Now', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'button_link', [
			'label' => esc_html__( 'Button Link', 'katlakit' ), 'type' => Controls_Manager::URL,
			'default' => [ 'url' => '#' ], 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'layout', [
			'label' => esc_html__( 'Layout', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [
				'stacked' => esc_html__( 'Stacked (Center)', 'katlakit' ),
				'inline'  => esc_html__( 'Inline (Split)', 'katlakit' ),
			],
			'default' => 'stacked',
		] );

		$this->end_controls_section();

		// Box Style
		$this->start_controls_section( 'style_box', [ 'label' => esc_html__( 'Box', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'box_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-cta-box' ] );
		$this->add_responsive_control( 'box_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-cta-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'box_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-cta-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'box_shadow', 'selector' => '{{WRAPPER}} .kk-cta-box' ] );
		$this->end_controls_section();

		// Content Style
		$this->start_controls_section( 'style_content', [ 'label' => esc_html__( 'Content', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'title_color', [ 'label' => esc_html__( 'Title Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-cta-title' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .kk-cta-title' ] );
		$this->add_control( 'desc_color', [ 'label' => esc_html__( 'Description Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .kk-cta-desc' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .kk-cta-desc' ] );
		$this->end_controls_section();

		// Button Style
		$this->start_controls_section( 'style_button', [ 'label' => esc_html__( 'Button', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .kk-cta-btn' ] );
		$this->add_responsive_control( 'btn_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-cta-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->start_controls_tabs( 'tabs_btn' );
		$this->start_controls_tab( 'tab_btn_normal', [ 'label' => esc_html__( 'Normal', 'katlakit' ) ] );
		$this->add_control( 'btn_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-cta-btn' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-cta-btn' ] );
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_btn_hover', [ 'label' => esc_html__( 'Hover', 'katlakit' ) ] );
		$this->add_control( 'btn_hover_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-cta-btn:hover' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_hover_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-cta-btn:hover' ] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control( 'btn_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-cta-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();
