<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		
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
		?>
		<<?php echo esc_attr( $tag ); ?> <?php if ( $url ) { echo 'href="' . esc_url( $url ) . '"'; echo $target ? ' target="_blank"' : ''; echo $nofollow ? ' rel="nofollow"' : ''; } ?> class="kk-glass-card" style="display: block; text-decoration: none;">
			<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
				<div class="kk-gc-image">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', 'image' ) ); ?>
				</div>
			<?php endif; ?>
			
			<div class="kk-gc-content">
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<h3 class="kk-gc-title"><?php echo esc_html( $settings['title'] ); ?></h3>
				<?php endif; ?>
				
				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="kk-gc-desc"><?php echo wp_kses_post( $settings['description'] ); ?></p>
				<?php endif; ?>
			</div>
		</<?php echo esc_attr( $tag ); ?>>
		<?php
