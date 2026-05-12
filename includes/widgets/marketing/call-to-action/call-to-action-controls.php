<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Call to Action', 'katlakit' ) ] );
		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'katlakit' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'left'   => esc_html__( 'Left', 'katlakit' ),
				'center' => esc_html__( 'Center', 'katlakit' ),
				'right'  => esc_html__( 'Right', 'katlakit' ),
			],
			'default' => 'center',
		] );
		$this->add_control( 'title', [ 'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Call to Action Title', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'description', [ 'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__( 'This is the call to action description.', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_text', [ 'label' => esc_html__( 'Button Text', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Get Started', 'katlakit' ), 'dynamic' => [ 'active' => true ] ] );
		$this->add_control( 'button_link', [ 'label' => esc_html__( 'Button Link', 'katlakit' ), 'type' => Controls_Manager::URL, 'default' => [ 'url' => '#' ], 'dynamic' => [ 'active' => true ] ] );
		$this->end_controls_section();

		$this->register_animation_section();
