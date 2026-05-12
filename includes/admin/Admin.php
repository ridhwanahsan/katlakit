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

	/**
	 * Allowed dashboard tabs.
	 *
	 * @var string[]
	 */
	private $allowed_tabs = [
		'basic-widgets',
		'creative-widgets',
		'marketing-widgets',
		'woo-widgets',
		'extensions',
		'header-footer',
		'license',
		'system',
	];

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'register_menu' ], 9 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
		new Ajax(); // Initialize AJAX handlers
	}

	public function enqueue_assets( string $hook ): void {
		if ( 'toplevel_page_katlakit' !== $hook ) {
			return;
		}

		// Enqueue Google Fonts
		wp_enqueue_style( 'katlakit-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', [], KATLAKIT_VERSION );

		// Enqueue CSS
		wp_enqueue_style( 'katlakit-admin-layout', KATLAKIT_URL . 'assets/css/admin-layout.css', [], KATLAKIT_VERSION );
		wp_enqueue_style( 'katlakit-admin-glassmorphism', KATLAKIT_URL . 'assets/css/admin-glassmorphism.css', [], KATLAKIT_VERSION );
		wp_enqueue_style( 'katlakit-admin-components', KATLAKIT_URL . 'assets/css/admin-components.css', [], KATLAKIT_VERSION );

		// Enqueue JS
		wp_enqueue_script( 'katlakit-admin-tabs', KATLAKIT_URL . 'assets/js/admin-tabs.js', [ 'jquery' ], KATLAKIT_VERSION, true );
		wp_enqueue_script( 'katlakit-admin-ajax', KATLAKIT_URL . 'assets/js/admin-ajax.js', [ 'jquery' ], KATLAKIT_VERSION, true );

		wp_localize_script( 'katlakit-admin-ajax', 'katlakit_admin', [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'katlakit_save_settings' ),
		] );
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

		add_submenu_page(
			'katlakit',
			esc_html__( 'Dashboard', 'katlakit' ),
			esc_html__( 'Dashboard', 'katlakit' ),
			'manage_options',
			'katlakit',
			[ $this, 'render_dashboard' ]
		);
	}

	public function render_dashboard( string $forced_tab = '' ): void {
		$settings = \KatlaKit\Plugin::instance()->get_settings();
		$template = KATLAKIT_PATH . 'templates/admin/dashboard.php';
		$active_tab = $this->get_active_tab( $forced_tab );

		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	/**
	 * Resolve the active dashboard tab safely.
	 *
	 * @param string $forced_tab Force a specific tab when needed.
	 * @return string
	 */
	private function get_active_tab( string $forced_tab = '' ): string {
		if ( in_array( $forced_tab, $this->allowed_tabs, true ) ) {
			return $forced_tab;
		}

		$tab = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		if ( in_array( $tab, $this->allowed_tabs, true ) ) {
			return $tab;
		}

		return 'basic-widgets';
	}
}
