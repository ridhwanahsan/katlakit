<?php
/**
 * Default Plugin Settings Configuration
 *
 * This file returns an array of all default settings for the plugin,
 * including which widgets and extensions are enabled by default.
 *
 * @package KatlaKit\Config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	// Basic widgets.
	'widget_advanced_heading'        => '1',
	'widget_fancy_button'            => '1',
	'widget_info_box'                => '1',
	'widget_team_member'             => '1',
	'widget_testimonial'             => '1',
	'widget_pricing_table'           => '1',
	'widget_dual_button'             => '1',
	// Creative widgets.
	'widget_image_hover_card'        => '1',
	'widget_interactive_banner'      => '1',
	'widget_glassmorphism_card'      => '1',
	'widget_before_after_image'      => '1',
	'widget_timeline'                => '1',
	'widget_flip_box'                => '1',
	// Marketing widgets.
	'widget_countdown_timer'         => '1',
	'widget_call_to_action'          => '1',
	'widget_logo_carousel'           => '1',
	'widget_stats_counter'           => '1',
	'widget_faq_accordion'           => '1',
	// WooCommerce widgets.
	'widget_product_grid'            => '1',
	'widget_product_carousel'        => '1',
	'widget_product_category_grid'   => '1',
	'widget_add_to_cart_button'      => '1',
	'widget_product_tabs'            => '1',
	// Extensions.
	'ext_sticky_section'             => '1',
	'ext_custom_breakpoints'         => '1',
	'ext_floating_effects'           => '1',
	'ext_parallax_effects'           => '1',
	'ext_reading_progress_bar'       => '1',
	// Global.
	'custom_css'                     => '',
	'custom_js'                      => '',
];
