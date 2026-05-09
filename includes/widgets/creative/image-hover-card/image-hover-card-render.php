<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		
		$effect = esc_attr( $settings['hover_effect'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$tag = 'div'; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$url = ''; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$target = false; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$nofollow = false; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		
		if ( ! empty( $settings['link']['url'] ) ) {
			$tag = 'a'; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
			$url = esc_url( $settings['link']['url'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
			$target = ! empty( $settings['link']['is_external'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
			$nofollow = ! empty( $settings['link']['nofollow'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		}
		
		$image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'image', $settings ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		if ( ! $image_url ) {
			$image_url = $settings['image']['url']; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		}
		?>
		
		<<?php echo esc_attr( $tag ); ?> <?php if ( $url ) { echo 'href="' . esc_url( $url ) . '"'; echo $target ? ' target="_blank"' : ''; echo $nofollow ? ' rel="nofollow"' : ''; } ?> class="kk-image-hover-card kk-ihc-<?php echo esc_attr( $effect ); ?>" style="display: block; position: relative; overflow: hidden; text-decoration: none;">
			
			<div class="kk-ihc-bg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('<?php echo esc_url( $image_url ); ?>'); background-size: cover; background-position: center; transition: transform 0.5s ease;"></div>
			
			<div class="kk-ihc-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; transition: opacity 0.4s ease;"></div>
			
			<div class="kk-ihc-content" style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px; z-index: 2; transition: all 0.4s ease;">
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<h3 class="kk-ihc-title" style="margin: 0 0 10px 0;"><?php echo esc_html( $settings['title'] ); ?></h3>
				<?php endif; ?>
				
				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="kk-ihc-desc" style="margin: 0;"><?php echo wp_kses_post( $settings['description'] ); ?></p>
				<?php endif; ?>
			</div>
			
			<style>
				.kk-image-hover-card:hover .kk-ihc-bg { transform: scale(1.1); }
				.kk-image-hover-card:hover .kk-ihc-overlay { opacity: 1; }
				
				/* Fade */
				.kk-ihc-fade .kk-ihc-content { opacity: 0; }
				.kk-ihc-fade:hover .kk-ihc-content { opacity: 1; }
				
				/* Slide Up */
				.kk-ihc-slide-up .kk-ihc-content { transform: translateY(100%); opacity: 0; }
				.kk-ihc-slide-up:hover .kk-ihc-content { transform: translateY(0); opacity: 1; }
				
				/* Zoom In */
				.kk-ihc-zoom-in .kk-ihc-content { transform: scale(0.8); opacity: 0; }
				.kk-ihc-zoom-in:hover .kk-ihc-content { transform: scale(1); opacity: 1; }
			</style>
		</<?php echo esc_attr( $tag ); ?>>
		<?php
