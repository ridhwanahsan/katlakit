<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$katlakit_settings = $this->get_settings_for_display();
		$katlakit_dir = esc_attr( $katlakit_settings['flip_direction'] );
		?>
		<div class="kk-flip-box" style="perspective: 1000px; position: relative; width: 100%;">
			<div class="kk-fb-inner kk-fb-dir-<?php echo esc_attr( $katlakit_dir ); ?>" style="position: absolute; width: 100%; height: 100%; text-align: center; transition: transform 0.6s; transform-style: preserve-3d;">
				
				<!-- Front -->
				<div class="kk-fb-front" style="position: absolute; width: 100%; height: 100%; backface-visibility: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; background: #f8fafc; border: 1px solid #e2e8f0;">
					<?php if ( ! empty( $katlakit_settings['front_icon']['value'] ) ) : ?>
						<div class="kk-fb-icon" style="font-size: 40px; margin-bottom: 20px; color: #7c3aed;">
							<?php \Elementor\Icons_Manager::render_icon( $katlakit_settings['front_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $katlakit_settings['front_title'] ) ) : ?><h3 style="margin: 0 0 10px 0;"><?php echo esc_html( $katlakit_settings['front_title'] ); ?></h3><?php endif; ?>
					<?php if ( ! empty( $katlakit_settings['front_desc'] ) ) : ?><p style="margin: 0;"><?php echo wp_kses_post( $katlakit_settings['front_desc'] ); ?></p><?php endif; ?>
				</div>

				<!-- Back -->
				<div class="kk-fb-back" style="position: absolute; width: 100%; height: 100%; backface-visibility: hidden; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; background: #7c3aed; color: #fff;">
					<?php if ( ! empty( $katlakit_settings['back_title'] ) ) : ?><h3 style="margin: 0 0 10px 0; color: #fff;"><?php echo esc_html( $katlakit_settings['back_title'] ); ?></h3><?php endif; ?>
					<?php if ( ! empty( $katlakit_settings['back_desc'] ) ) : ?><p style="margin: 0 0 20px 0;"><?php echo wp_kses_post( $katlakit_settings['back_desc'] ); ?></p><?php endif; ?>
					<?php if ( ! empty( $katlakit_settings['button_text'] ) ) : 
						$katlakit_url = ! empty( $katlakit_settings['button_link']['url'] ) ? esc_url( $katlakit_settings['button_link']['url'] ) : '#';
					?>
						<a href="<?php echo esc_url( $katlakit_url ); ?>" style="display: inline-block; padding: 10px 20px; background: #fff; color: #7c3aed; text-decoration: none; border-radius: 4px; font-weight: bold;"><?php echo esc_html( $katlakit_settings['button_text'] ); ?></a>
					<?php endif; ?>
				</div>

			</div>
		</div>

		<style>
			/* Setup flips */
			.kk-fb-dir-right .kk-fb-back { transform: rotateY(180deg); }
			.kk-flip-box:hover .kk-fb-dir-right { transform: rotateY(180deg); }

			.kk-fb-dir-left .kk-fb-back { transform: rotateY(-180deg); }
			.kk-flip-box:hover .kk-fb-dir-left { transform: rotateY(-180deg); }

			.kk-fb-dir-up .kk-fb-back { transform: rotateX(180deg); }
			.kk-flip-box:hover .kk-fb-dir-up { transform: rotateX(180deg); }

			.kk-fb-dir-down .kk-fb-back { transform: rotateX(-180deg); }
			.kk-flip-box:hover .kk-fb-dir-down { transform: rotateX(-180deg); }
		</style>
		<?php
