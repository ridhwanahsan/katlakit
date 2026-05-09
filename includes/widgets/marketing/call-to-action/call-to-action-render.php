<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$layout   = esc_attr( $settings['layout'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		
		$url = ! empty( $settings['button_link']['url'] ) ? esc_url( $settings['button_link']['url'] ) : '#'; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$target = ! empty( $settings['button_link']['is_external'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$nofollow = ! empty( $settings['button_link']['nofollow'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		?>
		
		<div class="kk-cta-box kk-cta-<?php echo esc_attr( $layout ); ?>" style="<?php echo $layout === 'inline' ? 'display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;' : 'text-align: center;'; ?>">
			<div class="kk-cta-content" style="<?php echo $layout === 'inline' ? 'flex: 1; min-width: 300px;' : 'margin-bottom: 20px;'; ?>">
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<h2 class="kk-cta-title" style="margin: 0 0 10px 0;"><?php echo esc_html( $settings['title'] ); ?></h2>
				<?php endif; ?>
				
				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="kk-cta-desc" style="margin: 0;"><?php echo wp_kses_post( $settings['description'] ); ?></p>
				<?php endif; ?>
			</div>
			
			<?php if ( ! empty( $settings['button_text'] ) ) : ?>
				<div class="kk-cta-action">
					<a href="<?php echo esc_url( $url ); ?>" class="kk-cta-btn"<?php echo $target ? ' target="_blank"' : ''; ?><?php echo $nofollow ? ' rel="nofollow"' : ''; ?> style="display: inline-block; text-decoration: none; transition: all 0.3s;"><?php echo esc_html( $settings['button_text'] ); ?></a>
				</div>
			<?php endif; ?>
		</div>
		<?php
