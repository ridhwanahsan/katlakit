<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Query
		$this->start_controls_section( 'section_query', [ 'label' => esc_html__( 'Query', 'katlakit' ) ] );

		$this->add_control( 'posts_per_page', [
			'label' => esc_html__( 'Products Count', 'katlakit' ), 'type' => Controls_Manager::NUMBER,
			'default' => 4,
		] );

		$this->add_responsive_control( 'columns', [
			'label' => esc_html__( 'Columns', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6' ],
			'default' => '4',
			'selectors' => [ '{{WRAPPER}} .kk-product-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);' ],
		] );

		$this->add_control( 'orderby', [
			'label' => esc_html__( 'Order By', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [ 'date' => 'Date', 'price' => 'Price', 'sales' => 'Sales', 'rand' => 'Random' ],
			'default' => 'date',
		] );

		$this->add_control( 'order', [
			'label' => esc_html__( 'Order', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [ 'DESC' => 'Descending', 'ASC' => 'Ascending' ],
			'default' => 'DESC',
		] );

		$this->end_controls_section();

		// Layout
		$this->start_controls_section( 'section_layout', [ 'label' => esc_html__( 'Layout', 'katlakit' ) ] );
		$this->add_responsive_control( 'gap', [ 'label' => esc_html__( 'Gap', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-product-grid' => 'gap: {{SIZE}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Card Style
		$this->start_controls_section( 'style_card', [ 'label' => esc_html__( 'Product Card', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'card_bg', [ 'label' => esc_html__( 'Background', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-product-item' => 'background-color: {{VALUE}};' ] ] );
		$this->add_responsive_control( 'card_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-product-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'card_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-product-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'card_shadow', 'selector' => '{{WRAPPER}} .kk-product-item' ] );
		$this->end_controls_section();

		// Typography Style
		$this->start_controls_section( 'style_typography', [ 'label' => esc_html__( 'Typography', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'title_color', [ 'label' => esc_html__( 'Title Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-product-title a' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .kk-product-title a' ] );
		$this->add_control( 'price_color', [ 'label' => esc_html__( 'Price Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .price' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'price_typography', 'selector' => '{{WRAPPER}} .price' ] );
		$this->end_controls_section();
