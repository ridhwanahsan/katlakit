<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$this->start_controls_section( 'section_product', [ 'label' => esc_html__( 'Product', 'katlakit' ) ] );

		$this->add_control( 'product_id', [
			'label' => esc_html__( 'Product ID', 'katlakit' ), 'type' => Controls_Manager::NUMBER,
			'description' => esc_html__( 'Leave empty to use current global product.', 'katlakit' ),
		] );

		$this->add_control( 'show_quantity', [
			'label' => esc_html__( 'Show Quantity', 'katlakit' ), 'type' => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_responsive_control( 'align', [
			'label' => esc_html__( 'Alignment', 'katlakit' ), 'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left'   => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
				'justify'=> [ 'title' => esc_html__( 'Justify', 'katlakit' ),'icon' => 'eicon-text-align-justify' ],
			],
			'default'   => 'left',
			'selectors' => [ 
				'{{WRAPPER}} .kk-atc-wrap' => 'text-align: {{VALUE}};',
				'{{WRAPPER}} .kk-atc-wrap form.cart' => 'justify-content: {{VALUE}};'
			],
		] );

		$this->end_controls_section();

		// Button Style
		$this->start_controls_section( 'style_button', [ 'label' => esc_html__( 'Button', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'btn_typography', 'selector' => '{{WRAPPER}} .single_add_to_cart_button' ] );
		$this->add_responsive_control( 'btn_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .single_add_to_cart_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		
		$this->start_controls_tabs( 'tabs_btn' );
		$this->start_controls_tab( 'tab_btn_normal', [ 'label' => esc_html__( 'Normal', 'katlakit' ) ] );
		$this->add_control( 'btn_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .single_add_to_cart_button' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .single_add_to_cart_button' ] );
		$this->end_controls_tab();
		
		$this->start_controls_tab( 'tab_btn_hover', [ 'label' => esc_html__( 'Hover', 'katlakit' ) ] );
		$this->add_control( 'btn_hover_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .single_add_to_cart_button:hover' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'btn_hover_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .single_add_to_cart_button:hover' ] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control( 'btn_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .single_add_to_cart_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Quantity Style
		$this->start_controls_section( 'style_qty', [ 'label' => esc_html__( 'Quantity', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => [ 'show_quantity' => 'yes' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'qty_typography', 'selector' => '{{WRAPPER}} .quantity input.qty' ] );
		$this->add_control( 'qty_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .quantity input.qty' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'qty_bg', 'types' => [ 'classic' ], 'selector' => '{{WRAPPER}} .quantity input.qty' ] );
		$this->add_group_control( Group_Control_Border::get_type(), [ 'name' => 'qty_border', 'selector' => '{{WRAPPER}} .quantity input.qty' ] );
		$this->add_control( 'qty_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .quantity input.qty' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_responsive_control( 'qty_width', [ 'label' => esc_html__( 'Width', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px' ], 'selectors' => [ '{{WRAPPER}} .quantity input.qty' => 'width: {{SIZE}}{{UNIT}};' ] ] );
		$this->end_controls_section();
