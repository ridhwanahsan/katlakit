<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;

// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [ 'label' => esc_html__( 'Countdown Timer', 'katlakit' ) ] );
		$this->add_control( 'due_date', [
			'label'       => esc_html__( 'Due Date', 'katlakit' ),
			'type'        => Controls_Manager::DATE_TIME,
			'default'     => gmdate( 'Y-m-d H:i', strtotime( '+1 month' ) ),
			'label_block' => true,
		] );
		$this->add_control( 'action_after_expire', [
			'label'   => esc_html__( 'Action After Expire', 'katlakit' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'none'    => esc_html__( 'None', 'katlakit' ),
				'message' => esc_html__( 'Show Message', 'katlakit' ),
				'hide'    => esc_html__( 'Hide Timer', 'katlakit' ),
			],
			'default' => 'none',
		] );
		$this->add_control( 'expire_message', [
			'label'     => esc_html__( 'Expire Message', 'katlakit' ),
			'type'      => Controls_Manager::TEXTAREA,
			'default'   => esc_html__( 'Offer has expired!', 'katlakit' ),
			'condition' => [ 'action_after_expire' => 'message' ],
		] );
		$this->end_controls_section();

		$this->register_animation_section();
