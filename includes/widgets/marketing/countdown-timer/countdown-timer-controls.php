<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Content
		$this->start_controls_section( 'section_timer', [ 'label' => esc_html__( 'Timer', 'katlakit' ) ] );

		$this->add_control( 'due_date', [
			'label' => esc_html__( 'Due Date', 'katlakit' ), 'type' => Controls_Manager::DATE_TIME,
			'default' => gmdate( 'Y-m-d H:i', strtotime( '+1 month' ) ),
			'description' => esc_html__( 'Date set according to your timezone.', 'katlakit' ),
		] );

		$this->add_control( 'show_days', [ 'label' => esc_html__( 'Days', 'katlakit' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ] );
		$this->add_control( 'show_hours', [ 'label' => esc_html__( 'Hours', 'katlakit' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ] );
		$this->add_control( 'show_minutes', [ 'label' => esc_html__( 'Minutes', 'katlakit' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ] );
		$this->add_control( 'show_seconds', [ 'label' => esc_html__( 'Seconds', 'katlakit' ), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes' ] );

		$this->add_control( 'label_days', [ 'label' => esc_html__( 'Days Label', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Days', 'katlakit' ), 'condition' => [ 'show_days' => 'yes' ] ] );
		$this->add_control( 'label_hours', [ 'label' => esc_html__( 'Hours Label', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Hours', 'katlakit' ), 'condition' => [ 'show_hours' => 'yes' ] ] );
		$this->add_control( 'label_minutes', [ 'label' => esc_html__( 'Minutes Label', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Minutes', 'katlakit' ), 'condition' => [ 'show_minutes' => 'yes' ] ] );
		$this->add_control( 'label_seconds', [ 'label' => esc_html__( 'Seconds Label', 'katlakit' ), 'type' => Controls_Manager::TEXT, 'default' => esc_html__( 'Seconds', 'katlakit' ), 'condition' => [ 'show_seconds' => 'yes' ] ] );

		$this->add_control( 'action_after_expire', [
			'label' => esc_html__( 'Action After Expire', 'katlakit' ), 'type' => Controls_Manager::SELECT,
			'options' => [
				'hide' => esc_html__( 'Hide Timer', 'katlakit' ),
				'message' => esc_html__( 'Show Message', 'katlakit' ),
				'redirect' => esc_html__( 'Redirect', 'katlakit' ),
			],
			'default' => 'hide',
		] );

		$this->add_control( 'expire_message', [ 'label' => esc_html__( 'Message', 'katlakit' ), 'type' => Controls_Manager::WYSIWYG, 'default' => esc_html__( 'This offer has expired.', 'katlakit' ), 'condition' => [ 'action_after_expire' => 'message' ] ] );
		$this->add_control( 'expire_redirect_url', [ 'label' => esc_html__( 'Redirect URL', 'katlakit' ), 'type' => Controls_Manager::URL, 'condition' => [ 'action_after_expire' => 'redirect' ] ] );
		
		$this->add_responsive_control( 'align', [
			'label' => esc_html__( 'Alignment', 'katlakit' ), 'type' => Controls_Manager::CHOOSE,
			'options' => [
				'flex-start' => [ 'title' => esc_html__( 'Left', 'katlakit' ),   'icon' => 'eicon-text-align-left' ],
				'center'     => [ 'title' => esc_html__( 'Center', 'katlakit' ), 'icon' => 'eicon-text-align-center' ],
				'flex-end'   => [ 'title' => esc_html__( 'Right', 'katlakit' ),  'icon' => 'eicon-text-align-right' ],
			],
			'default'   => 'center',
			'selectors' => [ '{{WRAPPER}} .kk-countdown' => 'justify-content: {{VALUE}};' ],
		] );

		$this->end_controls_section();

		// Style: Box
		$this->start_controls_section( 'style_box', [ 'label' => esc_html__( 'Box', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_group_control( Group_Control_Background::get_type(), [ 'name' => 'box_bg', 'selector' => '{{WRAPPER}} .kk-cd-item' ] );
		$this->add_group_control( Group_Control_Border::get_type(), [ 'name' => 'box_border', 'selector' => '{{WRAPPER}} .kk-cd-item' ] );
		$this->add_responsive_control( 'box_padding', [ 'label' => esc_html__( 'Padding', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', 'em' ], 'selectors' => [ '{{WRAPPER}} .kk-cd-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_control( 'box_radius', [ 'label' => esc_html__( 'Border Radius', 'katlakit' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => [ 'px', '%' ], 'selectors' => [ '{{WRAPPER}} .kk-cd-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ] ] );
		$this->add_responsive_control( 'box_gap', [ 'label' => esc_html__( 'Gap', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-countdown' => 'gap: {{SIZE}}{{UNIT}};' ] ] );
		$this->end_controls_section();

		// Style: Digits
		$this->start_controls_section( 'style_digits', [ 'label' => esc_html__( 'Digits', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'digit_color', [ 'label' => esc_html__( 'Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-cd-digit' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'digit_typography', 'selector' => '{{WRAPPER}} .kk-cd-digit' ] );
		$this->end_controls_section();

		// Style: Labels
		$this->start_controls_section( 'style_labels', [ 'label' => esc_html__( 'Labels', 'katlakit' ), 'tab' => Controls_Manager::TAB_STYLE ] );
		$this->add_control( 'label_color', [ 'label' => esc_html__( 'Color', 'katlakit' ), 'type' => Controls_Manager::COLOR, 'selectors' => [ '{{WRAPPER}} .kk-cd-label' => 'color: {{VALUE}};' ] ] );
		$this->add_group_control( Group_Control_Typography::get_type(), [ 'name' => 'label_typography', 'selector' => '{{WRAPPER}} .kk-cd-label' ] );
		$this->add_responsive_control( 'label_spacing', [ 'label' => esc_html__( 'Top Spacing', 'katlakit' ), 'type' => Controls_Manager::SLIDER, 'selectors' => [ '{{WRAPPER}} .kk-cd-label' => 'margin-top: {{SIZE}}{{UNIT}};' ] ] );
		$this->end_controls_section();
