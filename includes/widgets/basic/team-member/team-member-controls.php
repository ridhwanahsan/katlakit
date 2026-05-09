<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Team Member', 'katlakit' ) ] );

		$this->add_control( 'image', [
			'label' => esc_html__( 'Image', 'katlakit' ), 'type' => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ], 'dynamic' => [ 'active' => true ],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name' => 'image', 'default' => 'full', 'separator' => 'none',
		] );

		$this->add_control( 'name', [
			'label' => esc_html__( 'Name', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'John Doe', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'position', [
			'label' => esc_html__( 'Position', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'CEO & Founder', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'description', [
			'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'katlakit' ),
			'dynamic' => [ 'active' => true ],
		] );

		$repeater = new \Elementor\Repeater(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		$repeater->add_control( 'social_icon', [
			'label' => esc_html__( 'Icon', 'katlakit' ), 'type' => Controls_Manager::ICONS,
			'default' => [ 'value' => 'fab fa-twitter', 'library' => 'fa-brands' ],
		] );

		$repeater->add_control( 'social_link', [
			'label' => esc_html__( 'Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'social_profiles', [
			'label' => esc_html__( 'Social Profiles', 'katlakit' ), 'type' => Controls_Manager::REPEATER,
			'fields' => $repeater->get_controls(),
			'default' => [
				[ 'social_icon' => [ 'value' => 'fab fa-facebook-f', 'library' => 'fa-brands' ] ],
				[ 'social_icon' => [ 'value' => 'fab fa-twitter', 'library' => 'fa-brands' ] ],
				[ 'social_icon' => [ 'value' => 'fab fa-linkedin-in', 'library' => 'fa-brands' ] ],
			],
			'title_field' => '{{{ social_icon.value }}}',
		] );

		$this->add_responsive_control( 'text_align', [
			'label' => esc_html__( 'Alignment', 'katlakit' ), 'type' => Controls_Manager::CHOOSE,
			'options' => [
				'left'   => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center' => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'right'  => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'center',
			'selectors' => [ '{{WRAPPER}} .kk-team-member' => 'text-align: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// Style: Image
		$this->start_controls_section( 'style_image', [ 'label' => esc_html__( 'Image', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_responsive_control( 'image_size', [
			'label' => esc_html__( 'Size', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px', '%' ],
			'selectors' => [ '{{WRAPPER}} .kk-tm-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; object-fit: cover;' ],
		] );
		$this->add_control( 'image_border_radius', [
			'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ],
			'selectors' => [ '{{WRAPPER}} .kk-tm-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );
		$this->add_responsive_control( 'image_spacing', [
			'label' => esc_html__( 'Spacing', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'size_units' => [ 'px' ],
			'selectors' => [ '{{WRAPPER}} .kk-tm-image' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );
		$this->end_controls_section();

		// Style: Content
		$this->start_controls_section( 'style_content', [ 'label' => esc_html__( 'Content', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'name_color', [ 'label' => esc_html__( 'Name Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-tm-name' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'name_typography', 'selector' => '{{WRAPPER}} .kk-tm-name' ] );
		
		$this->add_control( 'position_color', [ 'label' => esc_html__( 'Position Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-tm-position' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'position_typography', 'selector' => '{{WRAPPER}} .kk-tm-position' ] );

		$this->add_control( 'desc_color', [ 'label' => esc_html__( 'Description Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-tm-desc' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'desc_typography', 'selector' => '{{WRAPPER}} .kk-tm-desc' ] );
		$this->end_controls_section();

		// Style: Social
		$this->start_controls_section( 'style_social', [ 'label' => esc_html__( 'Social Icons', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'social_color', [ 'label' => esc_html__( 'Icon Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-tm-social a' => 'color: {{VALUE}};' ] ] );
		$this->add_control( 'social_bg_color', [ 'label' => esc_html__( 'Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-tm-social a' => 'background-color: {{VALUE}};' ] ] );
		$this->add_control( 'social_hover_color', [ 'label' => esc_html__( 'Hover Icon Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-tm-social a:hover' => 'color: {{VALUE}};' ] ] );
		$this->add_control( 'social_hover_bg_color', [ 'label' => esc_html__( 'Hover Background Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-tm-social a:hover' => 'background-color: {{VALUE}};' ] ] );
		$this->add_responsive_control( 'social_size', [ 'label' => esc_html__( 'Size', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-tm-social a' => 'font-size: {{SIZE}}{{UNIT}}; width: calc({{SIZE}}{{UNIT}} * 2.5); height: calc({{SIZE}}{{UNIT}} * 2.5); line-height: calc({{SIZE}}{{UNIT}} * 2.5);' ] ] );
		$this->add_control( 'social_border_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-tm-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Box style.
		$this->start_controls_section( 'style_box', [ 'label' => esc_html__( 'Box', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'box_bg', 'types' => [ 'classic', 'gradient' ], 'selector' => '{{WRAPPER}} .kk-team-member' ] );
		$this->add_responsive_control( 'box_padding', [
			'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ],
			'selectors' => [ '{{WRAPPER}} .kk-team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );
		$this->add_control( 'box_border_radius', [
			'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ],
			'selectors' => [ '{{WRAPPER}} .kk-team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [ 'name' => 'box_shadow', 'selector' => '{{WRAPPER}} .kk-team-member' ] );
		$this->end_controls_section();

		$this->register_animation_section();
