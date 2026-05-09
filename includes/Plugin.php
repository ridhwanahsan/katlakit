<?php
/**
 * Core Plugin Singleton
 *
 * @package KatlaKit
 */

namespace KatlaKit;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Plugin
 *
 * Main singleton that bootstraps all KatlaKit subsystems.
 */
final class Plugin {

	/** @var Plugin|null Singleton instance. */
	private static $instance = null;

	/** @var array Merged plugin settings. */
	private $settings = [];

	/**
	 * Get or create the singleton instance.
	 *
	 * @return Plugin
	 */
	public static function instance(): Plugin {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Private constructor – use ::instance(). */
	private function __construct() {
		$this->load_settings();
		$this->register_hooks();
	}

	/** Prevent cloning. */
	private function __clone() {}

	/** Prevent unserialization. */
	public function __wakeup() {
		throw new \Exception( 'Cannot unserialize a singleton.' );
	}

	// ── Settings ──────────────────────────────────────────────────────────────

	/** Load and merge saved settings with defaults. */
	private function load_settings(): void {
		$saved          = get_option( 'katlakit_settings', [] );
		$defaults       = require KATLAKIT_INC_PATH . 'config/settings.php';
		$this->settings = wp_parse_args( $saved, $defaults );
	}

	/**
	 * Get a single setting value.
	 *
	 * @param  string $key     Setting key.
	 * @param  mixed  $default Fallback value.
	 * @return mixed
	 */
	public function get_setting( string $key, $default = '' ) {
		return isset( $this->settings[ $key ] ) ? $this->settings[ $key ] : $default;
	}

	/**
	 * Return all settings.
	 *
	 * @return array
	 */
	public function get_settings(): array {
		return $this->settings;
	}

	// ── Hooks ─────────────────────────────────────────────────────────────────

	/** Register WordPress & Elementor hooks. */
	private function register_hooks(): void {
		// Register widget categories.
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_categories' ] );

		// Init widget manager.
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Init extensions.
		add_action( 'elementor/init', [ $this, 'init_extensions' ] );

		// Asset helper.
		new Helpers\Assets();
	}

	// ── Widget Categories ─────────────────────────────────────────────────────

	/**
	 * Register custom Elementor widget categories.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Elementor manager.
	 */
	public function register_widget_categories( $elements_manager ): void {
		$categories = [
			'katlakit-basic' => [
				'title' => esc_html__( 'KatlaKit Basic', 'katlakit' ),
				'icon'  => 'eicon-flash',
			],
			'katlakit-creative' => [
				'title' => esc_html__( 'KatlaKit Creative', 'katlakit' ),
				'icon'  => 'eicon-paint-brush',
			],
			'katlakit-marketing' => [
				'title' => esc_html__( 'KatlaKit Marketing', 'katlakit' ),
				'icon'  => 'eicon-megaphone',
			],
			'katlakit-woocommerce' => [
				'title' => esc_html__( 'KatlaKit WooCommerce', 'katlakit' ),
				'icon'  => 'eicon-woocommerce',
			],
			'katlakit-pro' => [
				'title' => esc_html__( 'KatlaKit Pro', 'katlakit' ),
				'icon'  => 'eicon-pro-icon',
			],
			'katlakit-extensions' => [
				'title' => esc_html__( 'KatlaKit Extensions', 'katlakit' ),
				'icon'  => 'eicon-extensions',
			],
		];

		foreach ( $categories as $slug => $args ) {
			$elements_manager->add_category( $slug, $args );
		}
	}

	// ── Widgets ───────────────────────────────────────────────────────────────

	/**
	 * Delegate widget registration to the Widget_Manager.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor manager.
	 */
	public function register_widgets( $widgets_manager ): void {
		$manager = new Widgets\Widget_Manager( $this->settings );
		$manager->register( $widgets_manager );
	}

	// ── Extensions ────────────────────────────────────────────────────────────

	/** Initialise enabled extensions. */
	public function init_extensions(): void {
		$ext_manager = new Extensions\Extension_Manager( $this->settings );
		$ext_manager->init();
	}
}
