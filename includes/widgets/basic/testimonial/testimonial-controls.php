<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Utils;

// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [
			'label' => esc_html__( 'Testimonial', 'katlakit' ),
		] );

		$this->add_control( 'image', [
			'label'   => esc_html__( 'Image', 'katlakit' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ],
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'image',
			'default'   => 'thumbnail',
			'separator' => 'none',
		] );

		$this->add_control( 'name', [
			'label'       => esc_html__( 'Name', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'John Doe', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'job', [
			'label'       => esc_html__( 'Job/Title', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Designer', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'testimonial_content', [
			'label'       => esc_html__( 'Content', 'katlakit' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'katlakit' ),
			'label_block' => true,
			'dynamic'     => [ 'active' => true ],
		] );

		$this->add_control( 'rating', [
			'label'   => esc_html__( 'Rating', 'katlakit' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => 0,
			'max'     => 5,
			'step'    => 0.1,
			'default' => 5,
		] );

		$this->end_controls_section();

		// ── Style: Image ──────────────────────────────────────────────────────
		$this->start_controls_section( 'style_image', [
			'label' => esc_html__( 'Image', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'custom_image_dimension', [
			'label'      => esc_html__( 'Size', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 20, 'max' => 200 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-testimonial-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_control( 'image_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'image_spacing', [
			'label'      => esc_html__( 'Bottom Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-testimonial-image' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Content ────────────────────────────────────────────────────
		$this->start_controls_section( 'style_content', [
			'label' => esc_html__( 'Content', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'content_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-testimonial-text' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography',
			'selector' => '{{WRAPPER}} .kk-testimonial-text',
		] );

		$this->add_responsive_control( 'content_spacing', [
			'label'      => esc_html__( 'Bottom Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 100 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-testimonial-text' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Name & Job ─────────────────────────────────────────────────
		$this->start_controls_section( 'style_info', [
			'label' => esc_html__( 'Name & Job', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'name_heading', [
			'label'     => esc_html__( 'Name', 'katlakit' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'name_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-testimonial-name' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'selector' => '{{WRAPPER}} .kk-testimonial-name',
		] );

		$this->add_control( 'job_heading', [
			'label'     => esc_html__( 'Job', 'katlakit' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'job_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-testimonial-job' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'job_typography',
			'selector' => '{{WRAPPER}} .kk-testimonial-job',
		] );

		$this->end_controls_section();

		// ── Style: Rating ─────────────────────────────────────────────────────
		$this->start_controls_section( 'style_rating', [
			'label' => esc_html__( 'Rating', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'rating_color', [
			'label'     => esc_html__( 'Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f1c40f',
			'selectors' => [ '{{WRAPPER}} .kk-testimonial-rating' => 'color: {{VALUE}};' ],
		] );

		$this->add_responsive_control( 'rating_size', [
			'label'      => esc_html__( 'Size', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 10, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-testimonial-rating' => 'font-size: {{SIZE}}{{UNIT}};' ],
		] );

		$this->add_responsive_control( 'rating_spacing', [
			'label'      => esc_html__( 'Top Spacing', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
			'selectors'  => [ '{{WRAPPER}} .kk-testimonial-rating' => 'margin-top: {{SIZE}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		$this->register_animation_section();
