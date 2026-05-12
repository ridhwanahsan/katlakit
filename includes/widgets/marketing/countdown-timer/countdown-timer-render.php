<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$katlakit_settings = $this->get_settings_for_display();
		
		$katlakit_due_date = ! empty( $katlakit_settings['due_date'] ) ? strtotime( $katlakit_settings['due_date'] ) : 0;
		$katlakit_now      = current_time( 'timestamp' );
		
		if ( $katlakit_due_date <= $katlakit_now ) {
			if ( 'message' === $katlakit_settings['action_after_expire'] ) {
				echo '<div class="kk-countdown-expired">' . wp_kses_post( $katlakit_settings['expire_message'] ) . '</div>';
			} elseif ( 'redirect' === $katlakit_settings['action_after_expire'] && ! empty( $katlakit_settings['expire_redirect_url']['url'] ) ) {
				if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					echo '<script>window.location.href = "' . esc_url( $katlakit_settings['expire_redirect_url']['url'] ) . '";</script>';
				}
			}
			// If 'hide', do nothing (or in editor, show it empty)
			if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				return;
			}
		}

		// Calculate remaining for editor preview, actual JS will handle frontend
		$katlakit_diff = max( 0, $katlakit_due_date - $katlakit_now );
		$katlakit_days = floor( $katlakit_diff / ( 60 * 60 * 24 ) );
		$katlakit_hours = floor( ( $katlakit_diff % ( 60 * 60 * 24 ) ) / ( 60 * 60 ) );
		$katlakit_minutes = floor( ( $katlakit_diff % ( 60 * 60 ) ) / 60 );
		$katlakit_seconds = $katlakit_diff % 60;
		?>
		
		<div class="kk-countdown" data-date="<?php echo esc_attr( $katlakit_due_date ); ?>" style="display: flex;">
			<?php if ( 'yes' === $katlakit_settings['show_days'] ) : ?>
				<div class="kk-cd-item">
					<div class="kk-cd-digit kk-cd-days"><?php echo esc_html( sprintf( '%02d', $katlakit_days ) ); ?></div>
					<div class="kk-cd-label"><?php echo esc_html( $katlakit_settings['label_days'] ); ?></div>
				</div>
			<?php endif; ?>
			
			<?php if ( 'yes' === $katlakit_settings['show_hours'] ) : ?>
				<div class="kk-cd-item">
					<div class="kk-cd-digit kk-cd-hours"><?php echo esc_html( sprintf( '%02d', $katlakit_hours ) ); ?></div>
					<div class="kk-cd-label"><?php echo esc_html( $katlakit_settings['label_hours'] ); ?></div>
				</div>
			<?php endif; ?>
			
			<?php if ( 'yes' === $katlakit_settings['show_minutes'] ) : ?>
				<div class="kk-cd-item">
					<div class="kk-cd-digit kk-cd-minutes"><?php echo esc_html( sprintf( '%02d', $katlakit_minutes ) ); ?></div>
					<div class="kk-cd-label"><?php echo esc_html( $katlakit_settings['label_minutes'] ); ?></div>
				</div>
			<?php endif; ?>
			
			<?php if ( 'yes' === $katlakit_settings['show_seconds'] ) : ?>
				<div class="kk-cd-item">
					<div class="kk-cd-digit kk-cd-seconds"><?php echo esc_html( sprintf( '%02d', $katlakit_seconds ) ); ?></div>
					<div class="kk-cd-label"><?php echo esc_html( $katlakit_settings['label_seconds'] ); ?></div>
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
