<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

// Content
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Content', 'katlakit' ) ] );

		$this->add_control( 'image', [
			'label' => esc_html__( 'Image', 'katlakit' ), 'type' => Controls_Manager::MEDIA,
			'default' => [ 'url' => Utils::get_placeholder_image_src() ], 'dynamic' => [ 'active' => true ],
		] );
		$this->add_group_control( Group_Control_Image_Size::get_type(), [ 'name' => 'image', 'default' => 'large' ] );

		$this->add_control( 'title', [
			'label' => esc_html__( 'Title', 'katlakit' ), 'type' => Controls_Manager::TEXT,
			'default' => esc_html__( 'Hover Card Title', 'katlakit' ), 'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'description', [
			'label' => esc_html__( 'Description', 'katlakit' ), 'type' => Controls_Manager::TEXTAREA,
			'default' => esc_html__( 'Hover over this card to see the content.', 'katlakit' ),
			'dynamic' => [ 'active' => true ],
		] );

		$this->end_controls_section();

		$this->register_animation_section();
