<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$katlakit_settings = $this->get_settings_for_display();
		$katlakit_url      = ! empty( $katlakit_settings['button_link']['url'] ) ? esc_url( $katlakit_settings['button_link']['url'] ) : '#';
		$katlakit_target   = ! empty( $katlakit_settings['button_link']['is_external'] ) ? '_blank' : '_self';
		$katlakit_nofollow = ! empty( $katlakit_settings['button_link']['nofollow'] ) ? 'nofollow' : '';
		$katlakit_style    = esc_attr( $katlakit_settings['button_style'] ?? 'filled' );
		?>
		<div class="kk-btn-wrap">
			<a href="<?php echo esc_url( $katlakit_url ); ?>" class="kk-fancy-btn kk-btn-<?php echo esc_attr( $katlakit_style ); ?>" target="<?php echo esc_attr( $katlakit_target ); ?>"<?php echo $katlakit_nofollow ? ' rel="' . esc_attr( $katlakit_nofollow ) . '"' : ''; ?>>
				<?php if ( ! empty( $katlakit_settings['icon']['value'] ) && 'before' === $katlakit_settings['icon_position'] ) : ?>
					<span class="kk-btn-icon"><?php \Elementor\Icons_Manager::render_icon( $katlakit_settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
				<span class="kk-btn-text"><?php echo esc_html( $katlakit_settings['button_text'] ); ?></span>
				<?php if ( ! empty( $katlakit_settings['icon']['value'] ) && 'after' === $katlakit_settings['icon_position'] ) : ?>
					<span class="kk-btn-icon"><?php \Elementor\Icons_Manager::render_icon( $katlakit_settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
			</a>
		</div>
		<?php
