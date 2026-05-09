<?php
/**
 * KatlaKit Header/Footer Elementor Document
 *
 * @package KatlaKit\Modules
 */

namespace KatlaKit\Modules;

use Elementor\Core\DocumentTypes\Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor document definition for Header/Footer templates.
 */
class KK_HF_Document extends Post {

	/**
	 * Get document properties.
	 *
	 * @return array
	 */
	public static function get_properties() {
		$properties = parent::get_properties();

		$properties['cpt']                       = [ Header_Footer::POST_TYPE ];
		$properties['support_wp_page_templates'] = true;
		$properties['show_in_finder']            = true;

		return $properties;
	}

	/**
	 * Get the internal Elementor document type.
	 *
	 * @return string
	 */
	public static function get_type() {
		return 'katlakit-template';
	}

	/**
	 * Get the document title.
	 *
	 * @return string
	 */
	public static function get_title() {
		return esc_html__( 'KatlaKit Template', 'katlakit' );
	}

	/**
	 * Get the plural document title.
	 *
	 * @return string
	 */
	public static function get_plural_title() {
		return esc_html__( 'KatlaKit Templates', 'katlakit' );
	}

	/**
	 * Get the add new title.
	 *
	 * @return string
	 */
	public static function get_add_new_title() {
		return esc_html__( 'Add New KatlaKit Template', 'katlakit' );
	}

	/**
	 * Get the CSS wrapper selector for the document preview.
	 *
	 * @return string
	 */
	public function get_css_wrapper_selector() {
		return 'body.elementor-page-' . $this->get_main_id();
	}
}
