<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$settings = $this->get_settings_for_display(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$katlakit_tag = ! empty( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
		$katlakit_tag = in_array( $katlakit_tag, [ 'h1','h2','h3','h4','h5','h6','div','span','p' ], true ) ? $katlakit_tag : 'h2';

		// Process title – wrap highlight word.
		$katlakit_title = wp_kses_post( $settings['title'] );
		if ( ! empty( $settings['highlight_text'] ) ) {
			$katlakit_title = str_replace(
				esc_html( $settings['highlight_text'] ),
				'<span class="kk-highlight">' . esc_html( $settings['highlight_text'] ) . '</span>',
				$katlakit_title
			);
		}
		?>
		<div class="kk-advanced-heading">
			<?php if ( ! empty( $settings['sub_title'] ) ) : ?>
				<span class="kk-ah-subtitle"><?php echo esc_html( $settings['sub_title'] ); ?></span>
			<?php endif; ?>

			<<?php echo esc_attr( $katlakit_tag ); ?> class="kk-ah-title">
				<?php echo wp_kses_post( $katlakit_title ); ?>
			</<?php echo esc_attr( $katlakit_tag ); ?>>

			<?php if ( ! empty( $settings['description'] ) ) : ?>
				<p class="kk-ah-desc"><?php echo wp_kses_post( $settings['description'] ); ?></p>
			<?php endif; ?>
		</div>
		<?php
