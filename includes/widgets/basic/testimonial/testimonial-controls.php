<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Testimonial', 'katlakit' ) ] );

		$this->add_control( 'content', [
			'label' => esc_html__( 'Content', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA, 'rows' => 10,
			'default' => esc_html__( 'KatlaKit is simply the best Elementor addon I have ever used. It comes with so many useful widgets and the design is truly top-notch!', 'katlakit' ),
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'image', [
			'label' => esc_html__( 'Image', 'katlakit' ), 'type' => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ], 'dynamic' => [ 'active' => true ],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [ 'name' => 'image', 'default' => 'thumbnail', 'separator' => 'none' ] );

		$this->add_control( 'name', [
			'label' => esc_html__( 'Name', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Jane Doe', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'title', [
			'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Designer', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'rating', [
			'label' => esc_html__( 'Rating', 'katlakit' ), 'type' => Controls_Manager::NUMBER,
			'min' => 0, 'max' => 5, 'step' => 0.5, 'default' => 5,
		] );

		$this->add_control( 'show_quote_icon', [
			'label' => esc_html__( 'Show Quote Icon', 'katlakit' ), 'type' => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_responsive_control( 'text_align', [
			'label' => esc_html__( 'Alignment', 'katlakit' ), 'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left'   => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'center',
			'selectors' => [ '{{WRAPPER}} .kk-testimonial' => 'text-align: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// Style: Content
		$this->start_controls_section( 'style_content', [ 'label' => esc_html__( 'Content', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'content_color', [ 'label' => esc_html__( 'Text Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-testi-content' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'content_typography', 'selector' => '{{WRAPPER}} .kk-testi-content' ] );
		$this->end_controls_section();

		// Style: Author
		$this->start_controls_section( 'style_author', [ 'label' => esc_html__( 'Author', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_responsive_control( 'image_size', [ 'label' => esc_html__( 'Image Size', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-testi-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ] ] );
		$this->add_control( 'image_border_radius', [ 'label' => esc_html__( 'Image Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-testi-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'name_color', [ 'label' => esc_html__( 'Name Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .kk-testi-name' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'name_typography', 'selector' => '{{WRAPPER}} .kk-testi-name' ] );
		$this->add_control( 'title_color', [ 'label' => esc_html__( 'Title Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .kk-testi-title' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'title_typography', 'selector' => '{{WRAPPER}} .kk-testi-title' ] );
		$this->end_controls_section();

		// Style: Rating & Quote
		$this->start_controls_section( 'style_rating_quote', [ 'label' => esc_html__( 'Rating & Quote', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'rating_color', [ 'label' => esc_html__( 'Rating Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-testi-rating i' => 'color: {{VALUE}};' ] ] );
		$this->add_responsive_control( 'rating_size', [ 'label' => esc_html__( 'Rating Size', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-testi-rating i' => 'font-size: {{SIZE}}{{UNIT}};' ] ] );
		$this->add_control( 'quote_color', [ 'label' => esc_html__( 'Quote Icon Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'separator' => 'before', 'selectors' => [ '{{WRAPPER}} .kk-testi-quote-icon' => 'color: {{VALUE}};' ], 'condition' => [ 'show_quote_icon' => 'yes' ] ] );
		$this->add_responsive_control( 'quote_size', [ 'label' => esc_html__( 'Quote Icon Size', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-testi-quote-icon' => 'font-size: {{SIZE}}{{UNIT}};' ], 'condition' => [ 'show_quote_icon' => 'yes' ] ] );
		$this->end_controls_section();

		// Style: Box
		$this->start_controls_section( 'style_box', [ 'label' => esc_html__( 'Box', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'box_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-testimonial' ] );
		$this->add_responsive_control( 'box_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'box_border_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'box_shadow', 'selector' => '{{WRAPPER}} .kk-testimonial' ] );
		$this->end_controls_section();

		$this->register_animation_section();
