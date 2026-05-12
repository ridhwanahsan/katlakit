<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$katlakit_settings = $this->get_settings_for_display();
		$katlakit_tag = ! empty( $katlakit_settings['title_tag'] ) ? $katlakit_settings['title_tag'] : 'h2';
		$katlakit_tag = in_array( $katlakit_tag, [ 'h1','h2','h3','h4','h5','h6','div','span','p' ], true ) ? $katlakit_tag : 'h2';

		// Process title – wrap highlight word.
		$katlakit_title = wp_kses_post( $katlakit_settings['title'] );
		if ( ! empty( $katlakit_settings['highlight_text'] ) ) {
			$katlakit_title = str_replace(
				esc_html( $katlakit_settings['highlight_text'] ),
				'<span class="kk-highlight">' . esc_html( $katlakit_settings['highlight_text'] ) . '</span>',
				$katlakit_title
			);
		}
		?>
		<div class="kk-advanced-heading">
			<?php if ( ! empty( $katlakit_settings['sub_title'] ) ) : ?>
				<span class="kk-ah-subtitle"><?php echo esc_html( $katlakit_settings['sub_title'] ); ?></span>
			<?php endif; ?>

			<<?php echo esc_attr( $katlakit_tag ); ?> class="kk-ah-title">
				<?php echo wp_kses_post( $katlakit_title ); ?>
			</<?php echo esc_attr( $katlakit_tag ); ?>>

			<?php if ( ! empty( $katlakit_settings['description'] ) ) : ?>
				<p class="kk-ah-desc"><?php echo wp_kses_post( $katlakit_settings['description'] ); ?></p>
			<?php endif; ?>
		</div>
		<?php
