<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		?>
		<div class="kk-pricing-table">
			<?php if ( 'yes' === $settings['is_popular'] && ! empty( $settings['popular_text'] ) ) : ?>
				<div class="kk-pt-ribbon"><?php echo esc_html( $settings['popular_text'] ); ?></div>
			<?php endif; ?>

			<div class="kk-pt-header">
				<?php if ( ! empty( $settings['title'] ) ) : ?><h3 class="kk-pt-title"><?php echo esc_html( $settings['title'] ); ?></h3><?php endif; ?>
				<?php if ( ! empty( $settings['subtitle'] ) ) : ?><p class="kk-pt-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></p><?php endif; ?>
			</div>

			<div class="kk-pt-pricing">
				<?php if ( ! empty( $settings['currency'] ) ) : ?><span class="kk-pt-currency"><?php echo esc_html( $settings['currency'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $settings['price'] ) ) : ?><span class="kk-pt-price"><?php echo esc_html( $settings['price'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $settings['period'] ) ) : ?><span class="kk-pt-period"><?php echo esc_html( $settings['period'] ); ?></span><?php endif; ?>
				<?php if ( ! empty( $settings['original_price'] ) ) : ?><div class="kk-pt-original-price"><s><?php echo esc_html( $settings['original_price'] ); ?></s></div><?php endif; ?>
			</div>

			<?php if ( ! empty( $settings['features'] ) ) : ?>
				<ul class="kk-pt-features">
					<?php foreach ( $settings['features'] as $katlakit_index => $katlakit_item ) : 
						$repeater_class = $katlakit_item['feature_disabled'] === 'yes' ? ' kk-disabled' : ''; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
						?>
						<li class="kk-pt-feature elementor-repeater-item-<?php echo esc_attr( $katlakit_item['_id'] ); ?><?php echo esc_attr( $repeater_class ); ?>">
							<?php if ( ! empty( $katlakit_item['feature_icon']['value'] ) ) : ?>
								<span class="kk-pt-feature-icon"><?php \Elementor\Icons_Manager::render_icon( $katlakit_item['feature_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
							<?php endif; ?>
							<span class="kk-pt-feature-text"><?php echo wp_kses_post( $katlakit_item['feature_text'] ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<div class="kk-pt-footer">
				<?php if ( ! empty( $settings['button_text'] ) ) : 
					$katlakit_url = ! empty( $settings['button_link']['url'] ) ? esc_url( $settings['button_link']['url'] ) : '#';
					$katlakit_target = ! empty( $settings['button_link']['is_external'] ) ? ' target="_blank"' : '';
					$katlakit_nofollow = ! empty( $settings['button_link']['nofollow'] ) ? ' rel="nofollow"' : '';
					?>
					<a href="<?php echo esc_url( $katlakit_url ); ?>" class="kk-pt-button"<?php echo $katlakit_target; ?><?php echo $katlakit_nofollow; ?>><?php echo esc_html( $settings['button_text'] ); ?></a>
				<?php endif; ?>
				<?php if ( ! empty( $settings['additional_info'] ) ) : ?>
					<div class="kk-pt-info"><?php echo wp_kses_post( $settings['additional_info'] ); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php
