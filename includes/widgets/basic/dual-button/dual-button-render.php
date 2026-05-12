<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$katlakit_settings = $this->get_settings_for_display();

		$katlakit_url_1 = ! empty( $katlakit_settings['btn_1_link']['url'] ) ? esc_url( $katlakit_settings['btn_1_link']['url'] ) : '#';
		$katlakit_target_1 = ! empty( $katlakit_settings['btn_1_link']['is_external'] ) ? '_blank' : '';
		$katlakit_nofollow_1 = ! empty( $katlakit_settings['btn_1_link']['nofollow'] ) ? 'nofollow' : '';

		$katlakit_url_2 = ! empty( $katlakit_settings['btn_2_link']['url'] ) ? esc_url( $katlakit_settings['btn_2_link']['url'] ) : '#';
		$katlakit_target_2 = ! empty( $katlakit_settings['btn_2_link']['is_external'] ) ? '_blank' : '';
		$katlakit_nofollow_2 = ! empty( $katlakit_settings['btn_2_link']['nofollow'] ) ? 'nofollow' : '';
		?>
		<div class="kk-dual-btn-wrap" style="display: flex; align-items: center;">
			<a href="<?php echo esc_url( $katlakit_url_1 ); ?>" class="kk-db-btn-1"<?php echo $katlakit_target_1 ? ' target="' . esc_attr( $katlakit_target_1 ) . '"' : ''; ?><?php echo $katlakit_nofollow_1 ? ' rel="' . esc_attr( $katlakit_nofollow_1 ) . '"' : ''; ?>>
				<?php if ( ! empty( $katlakit_settings['btn_1_icon']['value'] ) && 'before' === $katlakit_settings['btn_1_icon_pos'] ) : ?>
					<span class="kk-db-icon before"><?php \Elementor\Icons_Manager::render_icon( $katlakit_settings['btn_1_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
				<span class="kk-db-text"><?php echo esc_html( $katlakit_settings['btn_1_text'] ); ?></span>
				<?php if ( ! empty( $katlakit_settings['btn_1_icon']['value'] ) && 'after' === $katlakit_settings['btn_1_icon_pos'] ) : ?>
					<span class="kk-db-icon after"><?php \Elementor\Icons_Manager::render_icon( $katlakit_settings['btn_1_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
			</a>

			<?php if ( 'yes' === $katlakit_settings['show_middle_text'] && ! empty( $katlakit_settings['middle_text'] ) ) : ?>
				<span class="kk-db-middle"><?php echo esc_html( $katlakit_settings['middle_text'] ); ?></span>
			<?php endif; ?>

			<a href="<?php echo esc_url( $katlakit_url_2 ); ?>" class="kk-db-btn-2"<?php echo $katlakit_target_2 ? ' target="' . esc_attr( $katlakit_target_2 ) . '"' : ''; ?><?php echo $katlakit_nofollow_2 ? ' rel="' . esc_attr( $katlakit_nofollow_2 ) . '"' : ''; ?>>
				<?php if ( ! empty( $katlakit_settings['btn_2_icon']['value'] ) && 'before' === $katlakit_settings['btn_2_icon_pos'] ) : ?>
					<span class="kk-db-icon before"><?php \Elementor\Icons_Manager::render_icon( $katlakit_settings['btn_2_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
				<span class="kk-db-text"><?php echo esc_html( $katlakit_settings['btn_2_text'] ); ?></span>
				<?php if ( ! empty( $katlakit_settings['btn_2_icon']['value'] ) && 'after' === $katlakit_settings['btn_2_icon_pos'] ) : ?>
					<span class="kk-db-icon after"><?php \Elementor\Icons_Manager::render_icon( $katlakit_settings['btn_2_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
			</a>
		</div>
		<?php
