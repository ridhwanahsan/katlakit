<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

// ── Content ───────────────────────────────────────────────────────────
		$this->start_controls_section( 'section_content', [
			'label' => esc_html__( 'Pricing Table', 'katlakit' ),
		] );

		$this->add_control( 'is_popular', [
			'label'        => esc_html__( 'Mark as Popular', 'katlakit' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'katlakit' ),
			'label_off'    => esc_html__( 'No', 'katlakit' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$this->add_control( 'popular_text', [
			'label'     => esc_html__( 'Popular Text', 'katlakit' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => esc_html__( 'Popular', 'katlakit' ),
			'condition' => [ 'is_popular' => 'yes' ],
		] );

		$this->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Standard', 'katlakit' ),
			'label_block' => true,
		] );

		$this->add_control( 'subtitle', [
			'label'       => esc_html__( 'Subtitle', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'For small businesses', 'katlakit' ),
			'label_block' => true,
		] );

		$this->add_control( 'currency', [
			'label'   => esc_html__( 'Currency', 'katlakit' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '$',
		] );

		$this->add_control( 'price', [
			'label'   => esc_html__( 'Price', 'katlakit' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '29',
		] );

		$this->add_control( 'period', [
			'label'   => esc_html__( 'Period', 'katlakit' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '/month',
		] );

		$this->add_control( 'original_price', [
			'label'   => esc_html__( 'Original Price (Optional)', 'katlakit' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '',
		] );

		$katlakit_repeater = new Repeater();

		$katlakit_repeater->add_control( 'feature_text', [
			'label'       => esc_html__( 'Feature Text', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'List Item', 'katlakit' ),
			'label_block' => true,
		] );

		$katlakit_repeater->add_control( 'feature_icon', [
			'label'   => esc_html__( 'Icon', 'katlakit' ),
			'type'    => Controls_Manager::ICONS,
			'default' => [
				'value'   => 'fas fa-check',
				'library' => 'fa-solid',
			],
		] );

		$katlakit_repeater->add_control( 'feature_disabled', [
			'label'        => esc_html__( 'Disable Feature', 'katlakit' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'katlakit' ),
			'label_off'    => esc_html__( 'No', 'katlakit' ),
			'return_value' => 'yes',
			'default'      => 'no',
		] );

		$this->add_control( 'features', [
			'label'   => esc_html__( 'Features', 'katlakit' ),
			'type'    => Controls_Manager::REPEATER,
			'fields'  => $katlakit_repeater->get_controls(),
			'default' => [
				[ 'feature_text' => esc_html__( 'Unlimited Users', 'katlakit' ) ],
				[ 'feature_text' => esc_html__( '10GB Storage', 'katlakit' ) ],
				[ 'feature_text' => esc_html__( '24/7 Support', 'katlakit' ) ],
				[ 'feature_text' => esc_html__( 'Email Integration', 'katlakit' ), 'feature_disabled' => 'yes' ],
			],
			'title_field' => '{{{ feature_text }}}',
		] );

		$this->add_control( 'button_text', [
			'label'       => esc_html__( 'Button Text', 'katlakit' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Choose Plan', 'katlakit' ),
			'label_block' => true,
		] );

		$this->add_control( 'button_link', [
			'label'   => esc_html__( 'Button Link', 'katlakit' ),
			'type'    => Controls_Manager::URL,
			'default' => [ 'url' => '#' ],
		] );

		$this->add_control( 'additional_info', [
			'label'       => esc_html__( 'Additional Info', 'katlakit' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => '',
			'label_block' => true,
		] );

		$this->end_controls_section();

		// ── Style: Header ─────────────────────────────────────────────────────
		$this->start_controls_section( 'style_header', [
			'label' => esc_html__( 'Header', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'header_bg_color', [
			'label'     => esc_html__( 'Background Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-header' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Title Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-title' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'selector' => '{{WRAPPER}} .kk-pt-title',
		] );

		$this->add_control( 'subtitle_color', [
			'label'     => esc_html__( 'Subtitle Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-subtitle' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'subtitle_typography',
			'selector' => '{{WRAPPER}} .kk-pt-subtitle',
		] );

		$this->add_responsive_control( 'header_padding', [
			'label'      => esc_html__( 'Padding', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-pt-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Pricing ────────────────────────────────────────────────────
		$this->start_controls_section( 'style_pricing', [
			'label' => esc_html__( 'Pricing', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'pricing_bg_color', [
			'label'     => esc_html__( 'Background Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-pricing' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'currency_color', [
			'label'     => esc_html__( 'Currency Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-currency' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'currency_typography',
			'selector' => '{{WRAPPER}} .kk-pt-currency',
		] );

		$this->add_control( 'price_color', [
			'label'     => esc_html__( 'Price Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-price' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'price_typography',
			'selector' => '{{WRAPPER}} .kk-pt-price',
		] );

		$this->add_control( 'period_color', [
			'label'     => esc_html__( 'Period Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-period' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'period_typography',
			'selector' => '{{WRAPPER}} .kk-pt-period',
		] );

		$this->add_control( 'original_price_color', [
			'label'     => esc_html__( 'Original Price Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-original-price' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'original_price_typography',
			'selector' => '{{WRAPPER}} .kk-pt-original-price',
		] );

		$this->add_responsive_control( 'pricing_padding', [
			'label'      => esc_html__( 'Padding', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-pt-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Features ───────────────────────────────────────────────────
		$this->start_controls_section( 'style_features', [
			'label' => esc_html__( 'Features', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'features_bg_color', [
			'label'     => esc_html__( 'Background Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-features' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'feature_text_color', [
			'label'     => esc_html__( 'Text Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-feature-text' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'feature_text_typography',
			'selector' => '{{WRAPPER}} .kk-pt-feature-text',
		] );

		$this->add_control( 'feature_icon_color', [
			'label'     => esc_html__( 'Icon Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-feature-icon' => 'color: {{VALUE}};' ],
		] );

		$this->add_control( 'feature_disabled_color', [
			'label'     => esc_html__( 'Disabled Feature Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-feature.kk-disabled' => 'color: {{VALUE}};' ],
		] );

		$this->add_responsive_control( 'features_padding', [
			'label'      => esc_html__( 'Padding', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-pt-features' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		// ── Style: Footer ─────────────────────────────────────────────────────
		$this->start_controls_section( 'style_footer', [
			'label' => esc_html__( 'Footer', 'katlakit' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'footer_bg_color', [
			'label'     => esc_html__( 'Background Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-footer' => 'background-color: {{VALUE}};' ],
		] );

		$this->add_control( 'button_color', [
			'label'     => esc_html__( 'Button Text Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-button' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'button_bg',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} .kk-pt-button',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'button_border',
			'selector' => '{{WRAPPER}} .kk-pt-button',
		] );

		$this->add_control( 'button_border_radius', [
			'label'      => esc_html__( 'Button Border Radius', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-pt-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'selector' => '{{WRAPPER}} .kk-pt-button',
		] );

		$this->add_control( 'additional_info_color', [
			'label'     => esc_html__( 'Additional Info Color', 'katlakit' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ '{{WRAPPER}} .kk-pt-info' => 'color: {{VALUE}};' ],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'additional_info_typography',
			'selector' => '{{WRAPPER}} .kk-pt-info',
		] );

		$this->add_responsive_control( 'footer_padding', [
			'label'      => esc_html__( 'Padding', 'katlakit' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [ '{{WRAPPER}} .kk-pt-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
		] );

		$this->end_controls_section();

		$this->register_animation_section();
