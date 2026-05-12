<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Group_Control_Image_Size;

$katlakit_settings = $this->get_settings_for_display();

$katlakit_url = ! empty( $katlakit_settings['link']['url'] ) ? esc_url( $katlakit_settings['link']['url'] ) : '';
$katlakit_target = ! empty( $katlakit_settings['link']['is_external'] ) ? '_blank' : '';
$katlakit_nofollow = ! empty( $katlakit_settings['link']['nofollow'] ) ? 'nofollow' : '';

$katlakit_tag = ! empty( $katlakit_url ) ? 'a' : 'div';
?>

<<?php echo esc_attr( $katlakit_tag ); ?><?php echo $katlakit_url ? ' href="' . esc_url( $katlakit_url ) . '"' : ''; ?><?php echo $katlakit_target ? ' target="' . esc_attr( $katlakit_target ) . '"' : ''; ?><?php echo $katlakit_nofollow ? ' rel="' . esc_attr( $katlakit_nofollow ) . '"' : ''; ?> class="kk-glass-card">
	<?php if ( ! empty( $katlakit_settings['image']['url'] ) ) : ?>
		<div class="kk-gc-image">
			<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $katlakit_settings, 'image', 'image' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="kk-gc-content">
		<?php if ( ! empty( $katlakit_settings['title'] ) ) : ?>
			<h3 class="kk-gc-title"><?php echo esc_html( $katlakit_settings['title'] ); ?></h3>
		<?php endif; ?>

		<?php if ( ! empty( $katlakit_settings['description'] ) ) : ?>
			<p class="kk-gc-desc"><?php echo wp_kses_post( $katlakit_settings['description'] ); ?></p>
		<?php endif; ?>
	</div>
</<?php echo esc_attr( $katlakit_tag ); ?>>

<style>
.kk-glass-card {
	transition: all 0.3s ease;
	text-decoration: none;
	display: block;
}
.kk-gc-image img {
	max-width: 100%;
	height: auto;
}
</style>
<?php
