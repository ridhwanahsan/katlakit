<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Group_Control_Image_Size;

$katlakit_settings = $this->get_settings_for_display();
?>

<div class="kk-image-hover-card">
	<?php if ( ! empty( $katlakit_settings['image']['url'] ) ) : ?>
		<div class="kk-ihc-image">
			<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $katlakit_settings, 'image', 'image' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="kk-ihc-overlay">
		<div class="kk-ihc-content">
			<?php if ( ! empty( $katlakit_settings['title'] ) ) : ?>
				<h3 class="kk-ihc-title"><?php echo esc_html( $katlakit_settings['title'] ); ?></h3>
			<?php endif; ?>

			<?php if ( ! empty( $katlakit_settings['description'] ) ) : ?>
				<p class="kk-ihc-desc"><?php echo wp_kses_post( $katlakit_settings['description'] ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

<style>
.kk-image-hover-card {
	position: relative;
	overflow: hidden;
	transition: all 0.3s ease;
}
.kk-ihc-image img {
	width: 100%;
	height: auto;
	transition: transform 0.5s ease;
}
.kk-ihc-overlay {
	position: absolute;
	top: 0; left: 0; right: 0; bottom: 0;
	background: rgba(0, 0, 0, 0.7);
	color: #fff;
	display: flex;
	align-items: center;
	justify-content: center;
	opacity: 0;
	transition: opacity 0.3s ease;
	padding: 20px;
	text-align: center;
}
.kk-image-hover-card:hover .kk-ihc-overlay {
	opacity: 1;
}
.kk-image-hover-card:hover .kk-ihc-image img {
	transform: scale(1.1);
}
</style>
<?php
