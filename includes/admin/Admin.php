<?php
/**
 * Admin Manager
 *
 * Handles admin menu registration and enqueues.
 *
 * @package KatlaKit\Admin
 */

namespace KatlaKit\Admin;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Admin {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_menu' ] );
		new Ajax(); // Initialize AJAX handlers
	}

	public function register_menu(): void {
		add_menu_page(
			esc_html__( 'KatlaKit', 'katlakit' ),
			esc_html__( 'KatlaKit', 'katlakit' ),
			'manage_options',
			'katlakit',
			[ $this, 'render_dashboard' ],
			'dashicons-layout',
			2
		);
	}

	public function render_dashboard(): void {
		$settings = \KatlaKit\Plugin::instance()->get_settings();
		$template = KATLAKIT_PATH . 'templates/admin/dashboard.php';

		if ( file_exists( $template ) ) {
			include $template;
		}
	}
}
