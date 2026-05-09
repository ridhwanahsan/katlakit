<?php
/**
 * Extension Manager
 *
 * Initialises enabled Elementor section extensions.
 *
 * @package KatlaKit\Extensions
 */

namespace KatlaKit\Extensions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Extension_Manager
 */
class Extension_Manager {

	/** @var array Plugin settings. */
	private array $settings;

	/**
	 * Constructor.
	 *
	 * @param array $settings Plugin settings array.
	 */
	public function __construct( array $settings ) {
		$this->settings = $settings;
	}

	/** Initialise each enabled extension. */
	public function init(): void {
		$map = [
			'ext_sticky_section'         => Sticky_Section::class,
			'ext_custom_breakpoints'     => Custom_Breakpoints::class,
			'ext_floating_effects'       => Floating_Effects::class,
			'ext_parallax_effects'       => Parallax_Effects::class,
			'ext_reading_progress_bar'   => Reading_Progress_Bar::class,
		];

		foreach ( $map as $key => $class ) {
			if ( ! empty( $this->settings[ $key ] ) && '1' === $this->settings[ $key ] ) {
				if ( class_exists( $class ) ) {
					( new $class() )->init();
				}
			}
		}
	}
}
