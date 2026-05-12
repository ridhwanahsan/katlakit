<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

// ── Content: Front ────────────────────────────────────────────────────
		$this->start_controls_section( 'section_front', [ 'label' => esc_html__( 'Front Side', 'katlakit' ) ] );
		$this->add_control( 'front_title', [ 'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Flip Box Front', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'front_desc', [ 'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'This is the front side description.', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'front_icon', [ 'label' => esc_html__( 'Icon', 'katlakit' ), 'type' => Controls_Manager::ICONS, 'default' => [ 'value' => 'fas fa-star', 'library' => 'fa-solid' ] ] );
		$this->end_controls_section();

		// ── Content: Back ─────────────────────────────────────────────────────
		$this->start_controls_section( 'section_back', [ 'label' => esc_html__( 'Back Side', 'katlakit' ) ] );
		$this->add_control( 'back_title', [ 'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Flip Box Back', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'back_desc', [ 'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'This is the back side description.', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_text', [ 'label' => esc_html__( 'Button Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Click Here', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_link', [ 'label' => esc_html__( 'Button Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#' ], 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		// ── Content: Settings ─────────────────────────────────────────────────
		$this->start_controls_section( 'section_settings', [ 'label' => esc_html__( 'Settings', 'katlakit' ) ] );
		$this->add_control( 'flip_direction', [
			'label'   => esc_html__( 'Flip Direction', 'katlakit' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'right' => esc_html__( 'Flip Right', 'katlakit' ),
				'left'  => esc_html__( 'Flip Left', 'katlakit' ),
				'up'    => esc_html__( 'Flip Up', 'katlakit' ),
				'down'  => esc_html__( 'Flip Down', 'katlakit' ),
			],
			'default' => 'right',
		] );
		$this->add_responsive_control( 'height', [
			'label'      => esc_html__( 'Height', 'katlakit' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [ 'px' => [ 'min' => 100, 'max' => 1000 ] ],
			'default'    => [ 'unit' => 'px', 'size' => 300 ],
			'selectors'  => [ '{{WRAPPER}} .kk-flip-box' => 'height: {{SIZE}}{{UNIT}};' ],
		] );
		$this->end_controls_section();

		$this->register_animation_section();
