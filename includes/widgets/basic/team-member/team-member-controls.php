<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Utils;

// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [
			'label' => esc_html__( 'Team Member', 'katlakit' ),
		] );

		$this->add_control( 'image', [
			'label'   => esc_html__( 'Image', 'katlakit' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ],
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'image',
			'default'   => 'medium',
			'separator' => 'none',
		] );

		$this->add_control( 'name', [
			'label'       => esc_html__( 'Name', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'John Doe', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'position', [
			'label'       => esc_html__( 'Position', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'CEO & Founder', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'description', [
			'label'       => esc_html__( 'Description', 'katlakit' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$katlakit_repeater = new Repeater();

		$katlakit_repeater->add_control( 'profile_icon', [
			'label'   => esc_html__( 'Icon', 'katlakit' ),
			'type'    => Controls_Manager::ICONS,
			'default' => [
				'value'   => 'fab fa-facebook-f',
				'library' => 'fa-brands',
			],
		] );

		$katlakit_repeater->add_control( 'profile_url', [
			'label'       => esc_html__( 'URL', 'katlakit' ),
			'type'        => Controls_Manager::URL,
			'default'     => [ 'url' => '#' ],
			'label_block' => true,
		] );

		$this->add_control( 'social_profiles', [
			'label'   => esc_html__( 'Social Profiles', 'katlakit' ),
			'type'    => Controls_Manager::REPEATER,
			'fields'  => $katlakit_repeater->get_controls(),
			'default' => [
				[ 'profile_icon' => [ 'value' => 'fab fa-facebook-f', 'library' => 'fa-brands' ] ],
				[ 'profile_icon' => [ 'value' => 'fab fa-twitter', 'library' => 'fa-brands' ] ],
				[ 'profile_icon' => [ 'value' => 'fab fa-linkedin-in', 'library' => 'fa-brands' ] ],
			],
			'title_field' => '<i class="{{ profile_icon.value }}"></i> {{{ profile_url.url }}}',
		] );

		$this->end_controls_section();

		// ── Style: Image ──────────────────────────────────────────────────────
		$this->start_controls_section( 'style_image', [
			'label' => esc_html__( 'Image', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'image_width', [
			'label'      => esc_html__( 'Width', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [ 'min' => 0, 'max' => 500 ],
				'%'  => [ 'min' => 0, 'max' => 100 ],
			],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-image img' => 'width: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'image_height', [
			'label'      => esc_html__( 'Height', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [ 'min' => 0, 'max' => 500 ],
				'%'  => [ 'min' => 0, 'max' => 100 ],
			],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-image img' => 'height: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_control( 'image_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'image_box_shadow',
			'selector' => '{{WRAPPER}} .kk-tm-image img',
		] );

		$this->add_responsive_control( 'image_spacing', [
			'label'      => esc_html__( 'Bottom Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-image' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Content ────────────────────────────────────────────────────
		$this->start_controls_section( 'style_content', [
			'label' => esc_html__( 'Content', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'name_color', [
			'label'     => esc_html__( 'Name Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-tm-name' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'selector' => '{{WRAPPER}} .kk-tm-name',
		] );

		$this->add_responsive_control( 'name_spacing', [
			'label'      => esc_html__( 'Bottom Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-name' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_control( 'position_color', [
			'label'     => esc_html__( 'Position Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-tm-position' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'selector' => '{{WRAPPER}} .kk-tm-position',
		] );

		$this->add_responsive_control( 'position_spacing', [
			'label'      => esc_html__( 'Bottom Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-position' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_control( 'description_color', [
			'label'     => esc_html__( 'Description Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-tm-desc' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'description_typography',
			'selector' => '{{WRAPPER}} .kk-tm-desc',
		] );

		$this->add_responsive_control( 'description_spacing', [
			'label'      => esc_html__( 'Bottom Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Social Profiles ────────────────────────────────────────────
		$this->start_controls_section( 'style_social_profiles', [
			'label' => esc_html__( 'Social Profiles', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'social_icon_size', [
			'label'      => esc_html__( 'Icon Size', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-social a' => 'font-size: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'social_icon_spacing', [
			'label'      => esc_html__( 'Icon Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-social a' => 'margin: 0 {{SIZE}}{{UNIT}};' ],
		] );

		$this->start_controls_tabs( 'social_icon_tabs' );

		$this->start_controls_tab( 'social_icon_normal', [ 'label' => esc_html__( 'Normal', 'katlakit' ) ] );

		$this->add_control( 'social_icon_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-tm-social a' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'social_icon_bg_color', [
			'label'     => esc_html__( 'Background Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-tm-social a' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'social_icon_border',
			'selector' => '{{WRAPPER}} .kk-tm-social a',
		] );

		$this->add_control( 'social_icon_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'social_icon_hover', [ 'label' => esc_html__( 'Hover', 'katlakit' ) ] );

		$this->add_control( 'social_icon_hover_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-tm-social a:hover' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'social_icon_hover_bg_color', [
			'label'     => esc_html__( 'Background Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-tm-social a:hover' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'social_icon_hover_border',
			'selector' => '{{WRAPPER}} .kk-tm-social a:hover',
		] );

		$this->add_control( 'social_icon_hover_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-tm-social a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->register_animation_section();
