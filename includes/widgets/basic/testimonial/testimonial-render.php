<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Group_Control_Image_Size;

$katlakit_settings = $this->get_settings_for_display();
		?>
		<div class="kk-testimonial">
			<?php if ( ! empty( $katlakit_settings['image']['url'] ) ) : ?>
				<div class="kk-testimonial-image">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $katlakit_settings, 'image', 'image' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="kk-testimonial-content">
				<?php if ( ! empty( $katlakit_settings['testimonial_content'] ) ) : ?>
					<div class="kk-testimonial-text">
						<?php echo wp_kses_post( $katlakit_settings['testimonial_content'] ); ?>
					</div>
				<?php endif; ?>

				<div class="kk-testimonial-meta">
					<?php if ( ! empty( $katlakit_settings['name'] ) ) : ?>
						<h4 class="kk-testimonial-name"><?php echo esc_html( $katlakit_settings['name'] ); ?></h4>
					<?php endif; ?>

					<?php if ( ! empty( $katlakit_settings['job'] ) ) : ?>
						<span class="kk-testimonial-job"><?php echo esc_html( $katlakit_settings['job'] ); ?></span>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $katlakit_settings['rating'] ) ) : ?>
					<div class="kk-testimonial-rating">
						<?php
						$katlakit_rating = floatval( $katlakit_settings['rating'] );
						for ( $katlakit_i = 1; $katlakit_i <= 5; $katlakit_i++ ) {
							if ( $katlakit_i <= $katlakit_rating ) {
								echo '<i class="fas fa-star"></i>';
							} elseif ( $katlakit_i - 0.5 <= $katlakit_rating ) {
								echo '<i class="fas fa-star-half-alt"></i>';
							} else {
								echo '<i class="far fa-star"></i>';
							}
						}
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
