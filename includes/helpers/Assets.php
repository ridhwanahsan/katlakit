<?php
/**
 * Assets Helper
 *
 * Handles shared frontend/admin asset enqueueing.
 *
 * @package KatlaKit\Helpers
 */

namespace KatlaKit\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Assets
 */
class Assets {

	/** Constructor – registers hooks. */
	public function __construct() {
		add_action( 'wp_enqueue_scripts',    [ $this, 'register_frontend_assets' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_assets' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_elementor_styles' ] );
	}

	/**
	 * Register (but NOT enqueue) shared frontend assets.
	 * Individual widgets enqueue their own assets on demand.
	 */
	public function register_frontend_assets(): void {
		wp_register_style(
			'katlakit-frontend',
			KATLAKIT_ASSETS_URL . 'css/frontend.css',
			[],
			KATLAKIT_VERSION
		);

		wp_register_script(
			'katlakit-frontend',
			KATLAKIT_ASSETS_URL . 'js/frontend.js',
			[ 'jquery' ],
			KATLAKIT_VERSION,
			true
		);
	}

	/**
	 * Enqueue global Elementor styles when Elementor is active on the page.
	 */
	public function enqueue_elementor_styles(): void {
		wp_enqueue_style( 'katlakit-frontend' );
	}

	/**
	 * Enqueue admin assets only on KatlaKit admin page.
	 *
	 * @param string $hook Current admin page hook.
	 */
	public function register_admin_assets( string $hook ): void {
		if ( strpos( $hook, 'katlakit' ) === false ) {
			return;
		}

		wp_enqueue_style(
			'katlakit-admin-layout',
			KATLAKIT_ASSETS_URL . 'css/admin-layout.css',
			[],
			KATLAKIT_VERSION
		);
		
		wp_enqueue_style(
			'katlakit-admin-components',
			KATLAKIT_ASSETS_URL . 'css/admin-components.css',
			[],
			KATLAKIT_VERSION
		);
		
		wp_enqueue_style(
			'katlakit-admin-glassmorphism',
			KATLAKIT_ASSETS_URL . 'css/admin-glassmorphism.css',
			[],
			KATLAKIT_VERSION
		);

		wp_enqueue_script(
			'katlakit-admin-tabs',
			KATLAKIT_ASSETS_URL . 'js/admin-tabs.js',
			[ 'jquery' ],
			KATLAKIT_VERSION,
			true
		);

		wp_enqueue_script(
			'katlakit-admin-ajax',
			KATLAKIT_ASSETS_URL . 'js/admin-ajax.js',
			[ 'jquery' ],
			KATLAKIT_VERSION,
			true
		);

		wp_localize_script(
			'katlakit-admin-ajax',
			'katlakitAdmin',
			[
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'katlakit_save_settings' ),
				'i18n'    => [
					'saving'  => esc_html__( 'Saving…', 'katlakit' ),
					'saved'   => esc_html__( 'Settings Saved!', 'katlakit' ),
					'error'   => esc_html__( 'Error saving settings.', 'katlakit' ),
				],
			]
		);
	}
}
