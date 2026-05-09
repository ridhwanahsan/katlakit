<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		?>
		<div class="kk-testimonial">
			<?php if ( 'yes' === $settings['show_quote_icon'] ) : ?>
				<div class="kk-testi-quote-icon"><i class="fas fa-quote-right" aria-hidden="true"></i></div>
			<?php endif; ?>

			<?php if ( ! empty( $settings['rating'] ) ) : ?>
				<div class="kk-testi-rating">
					<?php
					$katlakit_rating = (float) $settings['rating']; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
					for ( $katlakit_i = 1; $katlakit_i <= 5; $katlakit_i++ ) {
						if ( $katlakit_rating >= $katlakit_i ) { echo '<i class="fas fa-star"></i>'; }
						elseif ( $katlakit_rating >= $katlakit_i - 0.5 ) { echo '<i class="fas fa-star-half-alt"></i>'; }
						else { echo '<i class="far fa-star"></i>'; }
					}
					?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $settings['content'] ) ) : ?>
				<div class="kk-testi-content"><?php echo wp_kses_post( $settings['content'] ); ?></div>
			<?php endif; ?>

			<div class="kk-testi-author">
				<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
					<div class="kk-testi-image"><?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', 'image' ) ); ?></div>
				<?php endif; ?>
				<div class="kk-testi-author-info">
					<?php if ( ! empty( $settings['name'] ) ) : ?><h5 class="kk-testi-name"><?php echo esc_html( $settings['name'] ); ?></h5><?php endif; ?>
					<?php if ( ! empty( $settings['title'] ) ) : ?><span class="kk-testi-title"><?php echo esc_html( $settings['title'] ); ?></span><?php endif; ?>
				</div>
			</div>
		</div>
		<?php
