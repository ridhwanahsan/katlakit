<?php
/**
 * Utility / Helper Functions
 *
 * @package KatlaKit\Helpers
 */

namespace KatlaKit\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Utils
 */
class Utils {

	/**
	 * Return all KatlaKit widget categories for use in controls.
	 *
	 * @return array
	 */
	public static function get_widget_categories(): array {
		return [
			'katlakit-basic'        => esc_html__( 'KatlaKit Basic', 'katlakit' ),
			'katlakit-creative'     => esc_html__( 'KatlaKit Creative', 'katlakit' ),
			'katlakit-marketing'    => esc_html__( 'KatlaKit Marketing', 'katlakit' ),
			'katlakit-woocommerce'  => esc_html__( 'KatlaKit WooCommerce', 'katlakit' ),
		];
	}

	/**
	 * Sanitize a hex colour string.
	 *
	 * @param  string $color Hex colour.
	 * @return string
	 */
	public static function sanitize_color( string $color ): string {
		return sanitize_hex_color( $color ) ?? '';
	}

	/**
	 * Check if a string is a valid URL.
	 *
	 * @param  string $url URL to check.
	 * @return bool
	 */
	public static function is_valid_url( string $url ): bool {
		return filter_var( $url, FILTER_VALIDATE_URL ) !== false;
	}

	/**
	 * Render Elementor icon from icon control data.
	 *
	 * @param array $icon   Icon control value.
	 * @param array $attrs  Additional HTML attributes.
	 */
	public static function render_icon( array $icon, array $attrs = [] ): void {
		if ( empty( $icon['value'] ) ) {
			return;
		}
		\Elementor\Icons_Manager::render_icon( $icon, $attrs );
	}

	/**
	 * Get post types as key => label options array.
	 *
	 * @return array
	 */
	public static function get_post_types(): array {
		$post_types = get_post_types( [ 'public' => true ], 'objects' );
		$options    = [];

		foreach ( $post_types as $post_type ) {
			$options[ $post_type->name ] = $post_type->label;
		}

		return $options;
	}
}
