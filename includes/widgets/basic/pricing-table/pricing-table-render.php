<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$katlakit_settings = $this->get_settings_for_display();
		?>
		<div class="kk-pricing-table">
			<?php if ( 'yes' === $katlakit_settings['is_popular'] && ! empty( $katlakit_settings['popular_text'] ) ) : ?>
				<div class="kk-pt-ribbon"><?php echo esc_html( $katlakit_settings['popular_text'] ); ?></div>
			<?php endif; ?>

			<div class="kk-pt-header">
				<?php if ( ! empty( $katlakit_settings['title'] ) ) : ?><h3 class="kk-pt-title"><?php echo esc_html( $katlakit_settings['title'] ); ?></h3><?php endif; ?>
				<?php if ( ! empty( $katlakit_settings['subtitle'] ) ) : ?><p class="kk-pt-subtitle"><?php echo esc_html( $katlakit_settings['subtitle'] ); ?></p><?php endif; ?>
			</div>

			<div class="kk-pt-pricing">
				<?php if ( ! empty( $katlakit_settings['currency'] ) ) : ?><span class="kk-pt-currency"><?php echo esc_html( $katlakit_settings['currency'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $katlakit_settings['price'] ) ) : ?><span class="kk-pt-price"><?php echo esc_html( $katlakit_settings['price'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $katlakit_settings['period'] ) ) : ?><span class="kk-pt-period"><?php echo esc_html( $katlakit_settings['period'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $katlakit_settings['original_price'] ) ) : ?><div class="kk-pt-original-price"><s><?php echo esc_html( $katlakit_settings['original_price'] ); ?></s></div><?php endif; ?>
			</div>

			<?php if ( ! empty( $katlakit_settings['features'] ) ) : ?>
				<ul class="kk-pt-features">
					<?php foreach ( $katlakit_settings['features'] as $katlakit_index => $katlakit_item ) : 
						$katlakit_repeater_class = $katlakit_item['feature_disabled'] === 'yes' ? ' kk-disabled' : '';
						?>
						<li class="kk-pt-feature elementor-repeater-item-<?php echo esc_attr( $katlakit_item['_id'] ); ?><?php echo esc_attr( $katlakit_repeater_class ); ?>">
							<?php if ( ! empty( $katlakit_item['feature_icon']['value'] ) ) : ?>
								<span class="kk-pt-feature-icon"><?php \Elementor\Icons_Manager::render_icon( $katlakit_item['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
							<?php endif; ?>
							<span class="kk-pt-feature-text"><?php echo wp_kses_post( $katlakit_item['feature_text'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<div class="kk-pt-footer">
				<?php if ( ! empty( $katlakit_settings['button_text'] ) ) : 
					$katlakit_url = ! empty( $katlakit_settings['button_link']['url'] ) ? esc_url( $katlakit_settings['button_link']['url'] ) : '#';
					$katlakit_target = ! empty( $katlakit_settings['button_link']['is_external'] ) ? '_blank' : '';
					$katlakit_nofollow = ! empty( $katlakit_settings['button_link']['nofollow'] ) ? 'nofollow' : '';
					?>
					<a href="<?php echo esc_url( $katlakit_url ); ?>" class="kk-pt-button"<?php echo $katlakit_target ? ' target="' . esc_attr( $katlakit_target ) . '"' : ''; ?><?php echo $katlakit_nofollow ? ' rel="' . esc_attr( $katlakit_nofollow ) . '"' : ''; ?>><?php echo esc_html( $katlakit_settings['button_text'] ); ?></a>
				<?php endif; ?>
				<?php if ( ! empty( $katlakit_settings['additional_info'] ) ) : ?>
					<div class="kk-pt-info"><?php echo wp_kses_post( $katlakit_settings['additional_info'] ); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
