<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="wrap katlakit-admin-wrap">
	<div class="katlakit-header">
		<div class="katlakit-header-left">
			<h2><?php esc_html_e( 'KatlaKit Dashboard', 'katlakit' ); ?> <span class="katlakit-version">v<?php echo esc_html( KATLAKIT_VERSION ); ?></span></h2>
		</div>
		<div class="katlakit-header-right">
			<button id="katlakit-save-settings" class="button button-primary katlakit-btn"><?php esc_html_e( 'Save Settings', 'katlakit' ); ?></button>
		</div>
	</div>

	<div class="katlakit-main">
		<div class="katlakit-sidebar">
			<ul class="katlakit-nav">
				<li class="active" data-tab="basic-widgets"><?php esc_html_e( 'Basic Widgets', 'katlakit' ); ?></li>
				<li data-tab="creative-widgets"><?php esc_html_e( 'Creative Widgets', 'katlakit' ); ?></li>
				<li data-tab="marketing-widgets"><?php esc_html_e( 'Marketing Widgets', 'katlakit' ); ?></li>
				<li data-tab="woo-widgets"><?php esc_html_e( 'WooCommerce', 'katlakit' ); ?></li>
				<li data-tab="extensions"><?php esc_html_e( 'Extensions', 'katlakit' ); ?></li>
				<li data-tab="system"><?php esc_html_e( 'System Info', 'katlakit' ); ?></li>
			</ul>
		</div>

		<div class="katlakit-content">
			<form id="katlakit-settings-form">
				<!-- Basic Widgets -->
				<div class="katlakit-tab-content active" id="tab-basic-widgets">
					<h3><?php esc_html_e( 'Basic Widgets', 'katlakit' ); ?></h3>
					<div class="katlakit-grid">
						<?php 
						$katlakit_basic_widgets = [ 'advanced_heading', 'fancy_button', 'info_box', 'team_member', 'testimonial', 'pricing_table', 'dual_button' ];
						foreach ( $katlakit_basic_widgets as $katlakit_widget ) :
							$katlakit_checked = ( isset( $settings["widget_$katlakit_widget"] ) && '1' === $settings["widget_$katlakit_widget"] ) ? 'checked' : '';
						?>
						<div class="katlakit-card">
							<h4><?php echo esc_html( ucwords( str_replace( '_', ' ', $katlakit_widget ) ) ); ?></h4>
							<label class="katlakit-switch">
								<input type="checkbox" name="settings[widget_<?php echo esc_attr( $katlakit_widget ); ?>]" value="1" <?php echo esc_attr( $katlakit_checked ); ?>>
								<span class="katlakit-slider"></span>
							</label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>

				<!-- Creative Widgets -->
				<div class="katlakit-tab-content" id="tab-creative-widgets">
					<h3><?php esc_html_e( 'Creative Widgets', 'katlakit' ); ?></h3>
					<div class="katlakit-grid">
						<?php 
						$katlakit_creative_widgets = [ 'image_hover_card', 'interactive_banner', 'glassmorphism_card', 'before_after_image', 'timeline', 'flip_box' ];
						foreach ( $katlakit_creative_widgets as $katlakit_widget ) :
							$katlakit_checked = ( isset( $settings["widget_$katlakit_widget"] ) && '1' === $settings["widget_$katlakit_widget"] ) ? 'checked' : '';
						?>
						<div class="katlakit-card">
							<h4><?php echo esc_html( ucwords( str_replace( '_', ' ', $katlakit_widget ) ) ); ?></h4>
							<label class="katlakit-switch">
								<input type="checkbox" name="settings[widget_<?php echo esc_attr( $katlakit_widget ); ?>]" value="1" <?php echo esc_attr( $katlakit_checked ); ?>>
								<span class="katlakit-slider"></span>
							</label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>

				<!-- Extensions -->
				<div class="katlakit-tab-content" id="tab-extensions">
					<h3><?php esc_html_e( 'Extensions', 'katlakit' ); ?></h3>
					<div class="katlakit-grid">
						<?php 
						$katlakit_extensions = [ 'sticky_section', 'custom_breakpoints', 'floating_effects', 'parallax_effects', 'reading_progress_bar' ];
						foreach ( $katlakit_extensions as $katlakit_ext ) :
							$katlakit_checked = ( isset( $settings["ext_$katlakit_ext"] ) && '1' === $settings["ext_$katlakit_ext"] ) ? 'checked' : '';
						?>
						<div class="katlakit-card">
							<h4><?php echo esc_html( ucwords( str_replace( '_', ' ', $katlakit_ext ) ) ); ?></h4>
							<label class="katlakit-switch">
								<input type="checkbox" name="settings[ext_<?php echo esc_attr( $katlakit_ext ); ?>]" value="1" <?php echo esc_attr( $katlakit_checked ); ?>>
								<span class="katlakit-slider"></span>
							</label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				
				<!-- Dummy tabs for Marketing & Woo to prevent errors -->
				<div class="katlakit-tab-content" id="tab-marketing-widgets">
					<h3><?php esc_html_e( 'Marketing Widgets', 'katlakit' ); ?></h3>
					<p>Widgets loaded dynamically.</p>
				</div>
				<div class="katlakit-tab-content" id="tab-woo-widgets">
					<h3><?php esc_html_e( 'WooCommerce Widgets', 'katlakit' ); ?></h3>
					<p>Widgets loaded dynamically.</p>
				</div>
				<div class="katlakit-tab-content" id="tab-system">
					<h3><?php esc_html_e( 'System Status', 'katlakit' ); ?></h3>
					<table class="widefat">
						<tr><td>PHP Version</td><td><?php echo PHP_VERSION; ?></td></tr>
						<tr><td>WordPress Version</td><td><?php echo esc_html( get_bloginfo('version') ); ?></td></tr>
					</table>
				</div>

			</form>
		</div>
	</div>
</div>
