<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

		$katlakit_url_1 = ! empty( $settings['btn_1_link']['url'] ) ? esc_url( $settings['btn_1_link']['url'] ) : '#';
		$katlakit_target_1 = ! empty( $settings['btn_1_link']['is_external'] ) ? ' target="_blank"' : '';
		$katlakit_nofollow_1 = ! empty( $settings['btn_1_link']['nofollow'] ) ? ' rel="nofollow"' : '';

		$katlakit_url_2 = ! empty( $settings['btn_2_link']['url'] ) ? esc_url( $settings['btn_2_link']['url'] ) : '#';
		$katlakit_target_2 = ! empty( $settings['btn_2_link']['is_external'] ) ? ' target="_blank"' : '';
		$katlakit_nofollow_2 = ! empty( $settings['btn_2_link']['nofollow'] ) ? ' rel="nofollow"' : '';
		?>
		<div class="kk-dual-btn-wrap" style="display: flex; align-items: center;">
			<a href="<?php echo esc_url( $katlakit_url_1 ); ?>" class="kk-db-btn-1"<?php echo $katlakit_target_1; ?><?php echo $katlakit_nofollow_1; ?>>
				<?php if ( ! empty( $settings['btn_1_icon']['value'] ) && 'before' === $settings['btn_1_icon_pos'] ) : ?>
					<span class="kk-db-icon before"><?php \Elementor\Icons_Manager::render_icon( $settings['btn_1_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
				<span class="kk-db-text"><?php echo esc_html( $settings['btn_1_text'] ); ?></span>
				<?php if ( ! empty( $settings['btn_1_icon']['value'] ) && 'after' === $settings['btn_1_icon_pos'] ) : ?>
					<span class="kk-db-icon after"><?php \Elementor\Icons_Manager::render_icon( $settings['btn_1_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
			</a>

			<?php if ( 'yes' === $settings['show_middle_text'] && ! empty( $settings['middle_text'] ) ) : ?>
				<span class="kk-db-middle"><?php echo esc_html( $settings['middle_text'] ); ?></span>
			<?php endif; ?>

			<a href="<?php echo esc_url( $katlakit_url_2 ); ?>" class="kk-db-btn-2"<?php echo $katlakit_target_2; ?><?php echo $katlakit_nofollow_2; ?>>
				<?php if ( ! empty( $settings['btn_2_icon']['value'] ) && 'before' === $settings['btn_2_icon_pos'] ) : ?>
					<span class="kk-db-icon before"><?php \Elementor\Icons_Manager::render_icon( $settings['btn_2_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
				<span class="kk-db-text"><?php echo esc_html( $settings['btn_2_text'] ); ?></span>
				<?php if ( ! empty( $settings['btn_2_icon']['value'] ) && 'after' === $settings['btn_2_icon_pos'] ) : ?>
					<span class="kk-db-icon after"><?php \Elementor\Icons_Manager::render_icon( $settings['btn_2_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
				<?php endif; ?>
			</a>
		</div>
		<?php
