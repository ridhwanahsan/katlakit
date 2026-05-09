<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$url      = ! empty( $settings['button_link']['url'] ) ? esc_url( $settings['button_link']['url'] ) : '#'; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$target   = ! empty( $settings['button_link']['is_external'] ) ? '_blank' : '_self'; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$nofollow = ! empty( $settings['button_link']['nofollow'] ) ? ' rel="nofollow"' : ''; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$style    = esc_attr( $settings['button_style'] ?? 'filled' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		?>
		<div class="kk-btn-wrap">
			<a href="<?php echo esc_url( $url ); ?>" class="kk-fancy-btn kk-btn-<?php echo esc_attr( $style ); ?>" target="<?php echo esc_attr( $target ); ?>"<?php echo $nofollow ? ' rel="nofollow"' : ''; ?>>
				<?php if ( ! empty( $settings['icon']['value'] ) && 'before' === $settings['icon_position'] ) : ?>
					<span class="kk-btn-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
				<span class="kk-btn-text"><?php echo esc_html( $settings['button_text'] ); ?></span>
				<?php if ( ! empty( $settings['icon']['value'] ) && 'after' === $settings['icon_position'] ) : ?>
					<span class="kk-btn-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
			</a>
		</div>
		<?php
