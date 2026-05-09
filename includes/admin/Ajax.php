<?php
/**
 * Admin AJAX Handlers
 *
 * @package KatlaKit\Admin
 */

namespace KatlaKit\Admin;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Ajax {

	public function __construct() {
		add_action( 'wp_ajax_katlakit_save_settings', [ $this, 'save_settings' ] );
	}

	public function save_settings(): void {
		check_ajax_referer( 'katlakit_save_settings', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( [ 'message' => esc_html__( 'Unauthorized', 'katlakit' ) ] );
		}

		$current_settings = \KatlaKit\Plugin::instance()->get_settings();
		$new_settings     = isset( $_POST['settings'] ) ? (array) wp_unslash( $_POST['settings'] ) : []; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

		// Sanitize settings.
		$sanitized = [];
		foreach ( $new_settings as $key => $val ) {
			$sanitized[ sanitize_key( $key ) ] = sanitize_text_field( $val );
		}

		$merged = wp_parse_args( $sanitized, $current_settings );
		update_option( 'katlakit_settings', $merged );

		wp_send_json_success( [ 'message' => esc_html__( 'Settings saved successfully!', 'katlakit' ) ] );
	}
}
