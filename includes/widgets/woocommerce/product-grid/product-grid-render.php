<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		if ( ! class_exists( 'WooCommerce' ) ) {
			echo '<div class="kk-error">WooCommerce is not active.</div>';
			return;
		}

		$katlakit_query_args = [ // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => $settings['posts_per_page'],
			'order' => $settings['order'],
		];

		if ( 'price' === $settings['orderby'] ) {
			$katlakit_query_args['meta_key'] = '_price'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			$katlakit_query_args['orderby'] = 'meta_value_num';
		} elseif ( 'sales' === $settings['orderby'] ) {
		}

		$katlakit_query = new \WP_Query( $katlakit_query_args ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		?>
		<div class="kk-product-grid">
			<?php if ( $katlakit_query->have_posts() ) : ?>
				<?php while ( $katlakit_query->have_posts() ) : ?>
					<?php $katlakit_query->the_post(); ?>
				<?php
				$product = wc_get_product( get_the_ID() );
				if ( $product ) :
				?>
				<div class="kk-product-item">
					<div class="kk-product-image">
						<a href="<?php the_permalink(); ?>">
							<?php echo wp_kses_post( woocommerce_get_product_thumbnail() ); ?>
						</a>
						<div class="kk-product-action">
							<?php woocommerce_template_loop_add_to_cart(); ?>
						</div>
					</div>
					<div class="kk-product-info">
						<h3 class="kk-product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="kk-product-price">
							<?php echo wp_kses_post( $product->get_price_html() ); ?>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php
				endwhile;
				echo '</div>';
				wp_reset_postdata();
			else :
				echo '<div class="kk-no-products">' . esc_html__( 'No products found.', 'katlakit' ) . '</div>';
			endif;
		?>
		<?php
