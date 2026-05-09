<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Content: Button 1
		$this->start_controls_section( 'section_btn_1', [ 'label' => esc_html__( 'Button 1', 'katlakit' ) ] );
		$this->add_control( 'btn_1_text', [ 'label' => esc_html__( 'Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Primary Action', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'btn_1_link', [ 'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#' ], 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'btn_1_icon', [ 'label' => esc_html__( 'Icon', 'katlakit' ), 'type' => Controls_Manager::ICONS ] );
		$this->add_control( 'btn_1_icon_pos', [ 'label' => esc_html__( 'Icon Position', 'katlakit' ), 'type' => Controls_Manager::SELECT, 'options' => [ 'before' => esc_html__( 'Before', 'katlakit' ), 'after' => esc_html__( 'After', 'katlakit' ) ], 'default' => 'before', 'condition' => [ 'btn_1_icon[value]!' => '' ] ] );
		$this->end_controls_section();

		// Content: Middle Text
		$this->start_controls_section( 'section_middle_text', [ 'label' => esc_html__( 'Middle Text', 'katlakit' ) ] );
		$this->add_control( 'show_middle_text', [ 'label' => esc_html__( 'Show Text', 'katlakit' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ] );
		$this->add_control( 'middle_text', [ 'label' => esc_html__( 'Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'OR', 'katlakit' ), 'condition' => [ 'show_middle_text' => 'yes' ], 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		// Content: Button 2
		$this->start_controls_section( 'section_btn_2', [ 'label' => esc_html__( 'Button 2', 'katlakit' ) ] );
		$this->add_control( 'btn_2_text', [ 'label' => esc_html__( 'Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Secondary Action', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'btn_2_link', [ 'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#' ], 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'btn_2_icon', [ 'label' => esc_html__( 'Icon', 'katlakit' ), 'type' => Controls_Manager::ICONS ] );
		$this->add_control( 'btn_2_icon_pos', [ 'label' => esc_html__( 'Icon Position', 'katlakit' ), 'type' => Controls_Manager::SELECT, 'options' => [ 'before' => esc_html__( 'Before', 'katlakit' ), 'after' => esc_html__( 'After', 'katlakit' ) ], 'default' => 'after', 'condition' => [ 'btn_2_icon[value]!' => '' ] ] );
		$this->end_controls_section();

		// Content: Layout
		$this->start_controls_section( 'section_layout', [ 'label' => esc_html__( 'Layout', 'katlakit' ) ] );
		$this->add_responsive_control( 'gap', [ 'label' => esc_html__( 'Gap Between Buttons', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px', 'em' ], 'range' => [ 'px' => [ 'min' => 0, 'max' => 100 ] ], 'default' => [ 'unit' => 'px', 'size' => 20 ], 'selectors' => [ '{{WRAPPER}} .kk-dual-btn-wrap' => 'gap: {{SIZE}}{{UNIT}};' ] ] );
		$this->add_responsive_control( 'align', [
			'label' => esc_html__( 'Alignment', 'katlakit' ), 'type' => Controls_Manager::CHOOSE,
			'options' => [
				'flex-start' => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center'     => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'flex-end'   => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'center',
			'selectors' => [ '{{WRAPPER}} .kk-dual-btn-wrap' => 'justify-content: {{VALUE}};' ],
		] );
		$this->add_responsive_control( 'direction', [
			'label' => esc_html__( 'Direction', 'katlakit' ), 'type' => Controls_Manager::CHOOSE,
			'options' => [
				'row'    => [ 'title' => esc_html__( 'Row', 'katlakit' ),    'icon' => 'eicon-h-align-center' ],
				'column' => [ 'title' => esc_html__( 'Column', 'katlakit' ), 'icon' => 'eicon-v-align-center' ],
			],
			'default'   => 'row',
			'selectors' => [ '{{WRAPPER}} .kk-dual-btn-wrap' => 'flex-direction: {{VALUE}};' ],
		] );
		$this->end_controls_section();

		// Style: Button 1
		$this->start_controls_section( 'style_btn_1', [ 'label' => esc_html__( 'Button 1', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'btn_1_typography', 'selector' => '{{WRAPPER}} .kk-db-btn-1' ] );
		$this->add_responsive_control( 'btn_1_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-db-btn-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->start_controls_tabs( 'tabs_btn_1' );
		$this->start_controls_tab( 'tab_btn_1_normal', [ 'label' => esc_html__( 'Normal', 'katlakit' ) ] );
		$this->add_control( 'btn_1_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-db-btn-1' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_1_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-db-btn-1' ] );
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_btn_1_hover', [ 'label' => esc_html__( 'Hover', 'katlakit' ) ] );
		$this->add_control( 'btn_1_hover_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-db-btn-1:hover' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_1_hover_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-db-btn-1:hover' ] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control( 'btn_1_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-db-btn-1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'btn_1_shadow', 'selector' => '{{WRAPPER}} .kk-db-btn-1' ] );
		$this->end_controls_section();

		// Style: Middle Text
		$this->start_controls_section( 'style_middle_text', [ 'label' => esc_html__( 'Middle Text', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => [ 'show_middle_text' => 'yes' ] ] );
		$this->add_control( 'middle_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-db-middle' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'middle_typography', 'selector' => '{{WRAPPER}} .kk-db-middle' ] );
		$this->add_control( 'middle_bg_color', [ 'label' => esc_html__( 'Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-db-middle' => 'background-color: {{VALUE}};' ] ] );
		$this->add_responsive_control( 'middle_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-db-middle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'middle_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-db-middle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Style: Button 2
		$this->start_controls_section( 'style_btn_2', [ 'label' => esc_html__( 'Button 2', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'btn_2_typography', 'selector' => '{{WRAPPER}} .kk-db-btn-2' ] );
		$this->add_responsive_control( 'btn_2_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-db-btn-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->start_controls_tabs( 'tabs_btn_2' );
		$this->start_controls_tab( 'tab_btn_2_normal', [ 'label' => esc_html__( 'Normal', 'katlakit' ) ] );
		$this->add_control( 'btn_2_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-db-btn-2' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_2_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-db-btn-2' ] );
		$this->end_controls_tab();
		$this->start_controls_tab( 'tab_btn_2_hover', [ 'label' => esc_html__( 'Hover', 'katlakit' ) ] );
		$this->add_control( 'btn_2_hover_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-db-btn-2:hover' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_2_hover_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-db-btn-2:hover' ] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control( 'btn_2_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-db-btn-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'btn_2_shadow', 'selector' => '{{WRAPPER}} .kk-db-btn-2' ] );
		$this->end_controls_section();

		$this->register_animation_section();
