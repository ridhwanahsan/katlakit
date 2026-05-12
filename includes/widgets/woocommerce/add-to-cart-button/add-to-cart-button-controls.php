<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Add to Cart', 'katlakit' ) ] );
		$this->add_control( 'product_id', [
			'label'   => esc_html__( 'Product ID', 'katlakit' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '',
			'description' => esc_html__( 'Leave empty to use the current product ID.', 'katlakit' ),
		] );
		$this->add_control( 'show_quantity', [
			'label'   => esc_html__( 'Show Quantity', 'katlakit' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'no',
		] );
		$this->add_control( 'button_text', [
			'label'   => esc_html__( 'Button Text', 'katlakit' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Add to Cart', 'katlakit' ),
		] );
		$this->end_controls_section();

		$this->register_animation_section();
