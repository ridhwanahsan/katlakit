<?php
/**
 * Widget Manager
 *
 * Reads plugin settings and registers only the enabled widgets.
 *
 * @package KatlaKit\Widgets
 */

namespace KatlaKit\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Widget_Manager
 */
class Widget_Manager {

	/** @var array Plugin settings. */
	private array $settings;

	/** @var bool Whether WooCommerce is active. */
	private bool $woocommerce_active;

	/**
	 * Constructor.
	 *
	 * @param array $settings Plugin settings array.
	 */
	public function __construct( array $settings ) {
		$this->settings           = $settings;
		$this->woocommerce_active = class_exists( 'WooCommerce' );
	}

	/**
	 * Register all enabled widgets with Elementor.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor manager.
	 */
	public function register( $widgets_manager ): void {
		foreach ( $this->get_widget_map() as $key => $class ) {
			// Skip if setting is explicitly disabled.
			if ( isset( $this->settings[ 'widget_' . $key ] ) && '1' !== $this->settings[ 'widget_' . $key ] ) {
				continue;
			}

			// Skip WooCommerce widgets when WC is not active.
			if ( strpos( $key, 'product_' ) !== false || $key === 'add_to_cart_button' ) {
				if ( ! $this->woocommerce_active ) {
					continue;
				}
			}

			if ( class_exists( $class ) ) {
				$widgets_manager->register( new $class() );
			}
		}
	}

	/**
	 * Map of setting-key => fully-qualified class name for every widget.
	 *
	 * @return array
	 */
	private function get_widget_map(): array {
		return [
			// Basic.
			'advanced_heading'      => Basic\Advanced_Heading::class,
			'fancy_button'          => Basic\Fancy_Button::class,
			'info_box'              => Basic\Info_Box::class,
			'team_member'           => Basic\Team_Member::class,
			'testimonial'           => Basic\Testimonial::class,
			'pricing_table'         => Basic\Pricing_Table::class,
			'dual_button'           => Basic\Dual_Button::class,
			// Creative.
			'image_hover_card'      => Creative\Image_Hover_Card::class,
			'interactive_banner'    => Creative\Interactive_Banner::class,
			'glassmorphism_card'    => Creative\Glassmorphism_Card::class,
			'before_after_image'    => Creative\Before_After_Image::class,
			'timeline'              => Creative\Timeline::class,
			'flip_box'              => Creative\Flip_Box::class,
			// Marketing.
			'countdown_timer'       => Marketing\Countdown_Timer::class,
			'call_to_action'        => Marketing\Call_To_Action::class,
			'logo_carousel'         => Marketing\Logo_Carousel::class,
			'stats_counter'         => Marketing\Stats_Counter::class,
			'faq_accordion'         => Marketing\FAQ_Accordion::class,
			// WooCommerce.
			'product_grid'          => WooCommerce\Product_Grid::class,
			'product_carousel'      => WooCommerce\Product_Carousel::class,
			'product_category_grid' => WooCommerce\Product_Category_Grid::class,
			'add_to_cart_button'    => WooCommerce\Add_To_Cart_Button::class,
			'product_tabs'          => WooCommerce\Product_Tabs::class,
		];
	}
}
