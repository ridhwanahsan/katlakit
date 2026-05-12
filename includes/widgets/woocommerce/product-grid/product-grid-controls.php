<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Product Grid', 'katlakit' ) ] );
		$this->add_control( 'posts_per_page', [
			'label'   => esc_html__( 'Products Count', 'katlakit' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 4,
		] );
		$this->add_control( 'columns', [
			'label'   => esc_html__( 'Columns', 'katlakit' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
			],
			'default' => '4',
		] );
		$this->add_control( 'orderby', [
			'label'   => esc_html__( 'Order By', 'katlakit' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'date'  => esc_html__( 'Date', 'katlakit' ),
				'title' => esc_html__( 'Title', 'katlakit' ),
				'price' => esc_html__( 'Price', 'katlakit' ),
				'rand'  => esc_html__( 'Random', 'katlakit' ),
			],
			'default' => 'date',
		] );
		$this->add_control( 'order', [
			'label'   => esc_html__( 'Order', 'katlakit' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'ASC'  => esc_html__( 'ASC', 'katlakit' ),
				'DESC' => esc_html__( 'DESC', 'katlakit' ),
			],
			'default' => 'DESC',
		] );
		$this->end_controls_section();

		$this->register_animation_section();
