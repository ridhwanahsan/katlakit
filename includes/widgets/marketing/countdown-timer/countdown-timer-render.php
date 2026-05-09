<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		
		$due_date = ! empty( $settings['due_date'] ) ? strtotime( $settings['due_date'] ) : 0; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$now      = current_time( 'timestamp' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		
		if ( $due_date <= $now ) {
			if ( 'message' === $settings['action_after_expire'] ) {
				echo '<div class="kk-countdown-expired">' . wp_kses_post( $settings['expire_message'] ) . '</div>';
			} elseif ( 'redirect' === $settings['action_after_expire'] && ! empty( $settings['expire_redirect_url']['url'] ) ) {
				if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					echo '<script>window.location.href = "' . esc_url( $settings['expire_redirect_url']['url'] ) . '";</script>';
				}
			}
			// If 'hide', do nothing (or in editor, show it empty)
			if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				return;
			}
		}

		// Calculate remaining for editor preview, actual JS will handle frontend
		$diff = max( 0, $due_date - $now ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$days = floor( $diff / ( 60 * 60 * 24 ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$hours = floor( ( $diff % ( 60 * 60 * 24 ) ) / ( 60 * 60 ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$minutes = floor( ( $diff % ( 60 * 60 ) ) / 60 ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$seconds = $diff % 60; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		?>
		
		<div class="kk-countdown" data-date="<?php echo esc_attr( $due_date ); ?>" style="display: flex;">
			<?php if ( 'yes' === $settings['show_days'] ) : ?>
				<div class="kk-cd-item">
					<div class="kk-cd-digit kk-cd-days"><?php echo esc_html( sprintf( '%02d', $days ) ); ?></div>
					<div class="kk-cd-label"><?php echo esc_html( $settings['label_days'] ); ?></div>
				</div>
			<?php endif; ?>
			
			<?php if ( 'yes' === $settings['show_hours'] ) : ?>
				<div class="kk-cd-item">
					<div class="kk-cd-digit kk-cd-hours"><?php echo esc_html( sprintf( '%02d', $hours ) ); ?></div>
					<div class="kk-cd-label"><?php echo esc_html( $settings['label_hours'] ); ?></div>
				</div>
			<?php endif; ?>
			
			<?php if ( 'yes' === $settings['show_minutes'] ) : ?>
				<div class="kk-cd-item">
					<div class="kk-cd-digit kk-cd-minutes"><?php echo esc_html( sprintf( '%02d', $minutes ) ); ?></div>
					<div class="kk-cd-label"><?php echo esc_html( $settings['label_minutes'] ); ?></div>
				</div>
			<?php endif; ?>
			
			<?php if ( 'yes' === $settings['show_seconds'] ) : ?>
				<div class="kk-cd-item">
					<div class="kk-cd-digit kk-cd-seconds"><?php echo esc_html( sprintf( '%02d', $seconds ) ); ?></div>
					<div class="kk-cd-label"><?php echo esc_html( $settings['label_seconds'] ); ?></div>
				</div>
			<?php endif; ?>
		</div>
		
		<script>
		// Minimal frontend logic inline for brevity (usually in frontend.js)
		(function() {
			var wrap = document.currentScript.previousElementSibling;
			if(!wrap || wrap.className !== 'kk-countdown') return;
			var dest = parseInt(wrap.getAttribute('data-date')) * 1000;
			
			var updateTimer = setInterval(function() {
				var now = new Date().getTime();
				var diff = dest - now;
				
				if(diff < 0) {
					clearInterval(updateTimer);
					return;
				}
				
				var d = Math.floor(diff / (1000 * 60 * 60 * 24));
				var h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
				var s = Math.floor((diff % (1000 * 60)) / 1000);
				
				var elD = wrap.querySelector('.kk-cd-days');
				var elH = wrap.querySelector('.kk-cd-hours');
				var elM = wrap.querySelector('.kk-cd-minutes');
				var elS = wrap.querySelector('.kk-cd-seconds');
				
				if(elD) elD.innerHTML = (d < 10 ? '0' : '') + d;
				if(elH) elH.innerHTML = (h < 10 ? '0' : '') + h;
				if(elM) elM.innerHTML = (m < 10 ? '0' : '') + m;
				if(elS) elS.innerHTML = (s < 10 ? '0' : '') + s;
			}, 1000);
		})();
		</script>
		<?php
