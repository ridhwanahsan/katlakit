<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'WooCommerce' ) ) {
			echo '<div class="kk-error">WooCommerce is not active.</div>';
			return;
		}

		$katlakit_settings = $this->get_settings_for_display();
		global $product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		$katlakit_product_id = ! empty( $katlakit_settings['product_id'] ) ? absint( $katlakit_settings['product_id'] ) : get_the_ID();
		$katlakit_new_product = wc_get_product( $katlakit_product_id );

		if ( ! $katlakit_new_product ) {
			echo '<div class="kk-error">Product not found.</div>';
			return;
		}

		// Save current global product and set up new one.
		$katlakit_original_product = $product;
		$product = $katlakit_new_product;

		$katlakit_show_qty = 'yes' === $katlakit_settings['show_quantity'];
		?>
		<div class="kk-atc-wrap" style="width: 100%;">
			<style>
				.kk-atc-wrap form.cart { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
				<?php if ( ! $katlakit_show_qty ) : ?>
					.kk-atc-wrap .quantity { display: none !important; }
				<?php endif; ?>
				<?php if ( 'justify' === $katlakit_settings['align'] ) : ?>
					.kk-atc-wrap .single_add_to_cart_button { flex: 1; text-align: center; }
				<?php endif; ?>
			</style>
			<?php woocommerce_template_single_add_to_cart(); ?>
		</div>
		<?php

		// Restore original global product.
		$product = $katlakit_original_product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
