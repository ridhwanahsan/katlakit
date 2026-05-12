<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

$katlakit_settings = $this->get_settings_for_display();
		?>
		<div class="kk-team-member">
			<?php if ( ! empty( $katlakit_settings['image']['url'] ) ) : ?>
				<div class="kk-tm-image">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $katlakit_settings, 'image', 'image' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="kk-tm-content">
				<?php if ( ! empty( $katlakit_settings['name'] ) ) : ?>
					<h4 class="kk-tm-name"><?php echo esc_html( $katlakit_settings['name'] ); ?></h4>
				<?php endif; ?>

				<?php if ( ! empty( $katlakit_settings['position'] ) ) : ?>
					<span class="kk-tm-position"><?php echo esc_html( $katlakit_settings['position'] ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $katlakit_settings['description'] ) ) : ?>
					<p class="kk-tm-desc"><?php echo wp_kses_post( $katlakit_settings['description'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $katlakit_settings['social_profiles'] ) ) : ?>
					<div class="kk-tm-social">
						<?php foreach ( $katlakit_settings['social_profiles'] as $katlakit_profile ) : ?>
							<a href="<?php echo esc_url( $katlakit_profile['profile_url'] ); ?>" class="elementor-repeater-item-<?php echo esc_attr( $katlakit_profile['_id'] ); ?>" target="_blank">
								<?php Icons_Manager::render_icon( $katlakit_profile['profile_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
