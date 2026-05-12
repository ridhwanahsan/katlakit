<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$katlakit_settings = $this->get_settings_for_display();
		$katlakit_layout   = esc_attr( $katlakit_settings['layout'] );
		
		$katlakit_url = ! empty( $katlakit_settings['button_link']['url'] ) ? esc_url( $katlakit_settings['button_link']['url'] ) : '#';
		$katlakit_target = ! empty( $katlakit_settings['button_link']['is_external'] ) ? '_blank' : '';
		$katlakit_nofollow = ! empty( $katlakit_settings['button_link']['nofollow'] ) ? 'nofollow' : '';
		?>
		
		<div class="kk-cta-box kk-cta-<?php echo esc_attr( $katlakit_layout ); ?>" style="<?php echo 'inline' === $katlakit_layout ? 'display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;' : 'text-align: center;'; ?>">
			<div class="kk-cta-content" style="<?php echo 'inline' === $katlakit_layout ? 'flex: 1; min-width: 300px;' : 'margin-bottom: 20px;'; ?>">
				<?php if ( ! empty( $katlakit_settings['title'] ) ) : ?>
					<h2 class="kk-cta-title" style="margin: 0 0 10px 0;"><?php echo esc_html( $katlakit_settings['title'] ); ?></h2>
				<?php endif; ?>
				
				<?php if ( ! empty( $katlakit_settings['description'] ) ) : ?>
					<p class="kk-cta-desc" style="margin: 0;"><?php echo wp_kses_post( $katlakit_settings['description'] ); ?></p>
				<?php endif; ?>
			</div>
			
			<?php if ( ! empty( $katlakit_settings['button_text'] ) ) : ?>
				<div class="kk-cta-action">
					<a href="<?php echo esc_url( $katlakit_url ); ?>" class="kk-cta-btn"<?php echo $katlakit_target ? ' target="' . esc_attr( $katlakit_target ) . '"' : ''; ?><?php echo $katlakit_nofollow ? ' rel="' . esc_attr( $katlakit_nofollow ) . '"' : ''; ?> style="display: inline-block; text-decoration: none; transition: all 0.3s;"><?php echo esc_html( $katlakit_settings['button_text'] ); ?></a>
				</div>
			<?php endif; ?>
		</div>
		<?php
