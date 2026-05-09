<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WooCommerce' ) ) {
			echo '<div class="kk-error">WooCommerce is not active.</div>';
			return;
		}

		$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		global $product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		$product_id = ! empty( $settings['product_id'] ) ? absint( $settings['product_id'] ) : get_the_ID(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$_product = wc_get_product( $product_id ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		if ( ! $_product ) {
			echo '<div class="kk-error">Product not found.</div>';
			return;
		}

		// Save current global product and set up new one.
		$original_product = $product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$product = $_product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		$show_qty = 'yes' === $settings['show_quantity']; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		?>
		<div class="kk-atc-wrap" style="width: 100%;">
			<style>
				.kk-atc-wrap form.cart { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
				<?php if ( ! $show_qty ) : ?>
					.kk-atc-wrap .quantity { display: none !important; }
				<?php endif; ?>
				<?php if ( 'justify' === $settings['align'] ) : ?>
					.kk-atc-wrap .single_add_to_cart_button { flex: 1; text-align: center; }
				<?php endif; ?>
			</style>
			<?php woocommerce_template_single_add_to_cart(); ?>
		</div>
		<?php
if ( ! defined( 'ABSPATH' ) ) exit;

		// Restore original global product.
		$product = $original_product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
