<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		?>
		<div class="kk-team-member">
			<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
				<div class="kk-tm-image">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', 'image' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="kk-tm-content">
				<?php if ( ! empty( $settings['name'] ) ) : ?>
					<h4 class="kk-tm-name"><?php echo esc_html( $settings['name'] ); ?></h4>
				<?php endif; ?>

				<?php if ( ! empty( $settings['position'] ) ) : ?>
					<span class="kk-tm-position"><?php echo esc_html( $settings['position'] ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="kk-tm-desc"><?php echo wp_kses_post( $settings['description'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $settings['social_profiles'] ) ) : ?>
					<div class="kk-tm-social">
						<?php foreach ( $settings['social_profiles'] as $katlakit_profile ) : // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
							<a href="<?php echo esc_url( $katlakit_profile['profile_url'] ); ?>" class="elementor-repeater-item-<?php echo esc_attr( $katlakit_profile['_id'] ); ?>" target="_blank">
								<?php \Elementor\Icons_Manager::render_icon( $katlakit_profile['profile_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
