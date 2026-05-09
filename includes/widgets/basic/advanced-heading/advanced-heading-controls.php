<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [
			'label' => esc_html__( 'Heading', 'katlakit' ),
		] );

		$this->add_control( 'sub_title', [
			'label'       => esc_html__( 'Sub Title', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Welcome to KatlaKit', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'katlakit' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Build Stunning Pages', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'title_tag', [
			'label'   => esc_html__( 'HTML Tag', 'katlakit' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [ 'h1'=>'H1','h2'=>'H2','h3'=>'H3','h4'=>'H4','h5'=>'H5','h6'=>'H6','div'=>'div','span'=>'span','p'=>'p' ],
			'default' => 'h2',
		] );

		$this->add_control( 'highlight_text', [
			'label'   => esc_html__( 'Highlight Word', 'katlakit' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Stunning', 'katlakit' ),
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'description', [
			'label'   => esc_html__( 'Description', 'katlakit' ),
			'type'    => Controls_Manager::TEXTAREA,
			'default' => '',
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_responsive_control( 'text_align', [
			'label'     => esc_html__( 'Alignment', 'katlakit' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'left',
			'selectors' => [ '{{WRAPPER}} .kk-advanced-heading' => 'text-align: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Sub Title ──────────────────────────────────────────────────
		$this->start_controls_section( 'style_sub_title', [
			'label' => esc_html__( 'Sub Title', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'sub_title_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#7c3aed',
			'selectors' => [ '{{WRAPPER}} .kk-ah-subtitle' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'sub_title_typography',
			'selector' => '{{WRAPPER}} .kk-ah-subtitle',
		] );

		$this->add_responsive_control( 'sub_title_spacing', [
			'label'      => esc_html__( 'Bottom Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
			'default'    => [ 'unit' => 'px', 'size' => 12 ],
			'selectors'  => [ '{{WRAPPER}} .kk-ah-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Title ──────────────────────────────────────────────────────
		$this->start_controls_section( 'style_title', [
			'label' => esc_html__( 'Title', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#1e293b',
			'selectors' => [ '{{WRAPPER}} .kk-ah-title' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'highlight_color', [
			'label'     => esc_html__( 'Highlight Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#7c3aed',
			'selectors' => [ '{{WRAPPER}} .kk-ah-title .kk-highlight' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .kk-ah-title',
		] );

		$this->add_group_control( Group_Control_Text_Shadow::get_type(), [
			'name'     => 'title_text_shadow',
			'selector' => '{{WRAPPER}} .kk-ah-title',
		] );

		$this->end_controls_section();

		// ── Style: Description ────────────────────────────────────────────────
		$this->start_controls_section( 'style_description', [
			'label' => esc_html__( 'Description', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'desc_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-ah-desc' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'desc_typography',
			'selector' => '{{WRAPPER}} .kk-ah-desc',
		] );

		$this->end_controls_section();

		$this->register_animation_section();
