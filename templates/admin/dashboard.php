<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$katlakit_active_tab = isset( $active_tab ) && is_string( $active_tab ) ? $active_tab : 'basic-widgets';
$katlakit_settings = isset( $settings ) ? $settings : [];
?>

<div class="wrap katlakit-admin-wrap">
	<div class="katlakit-glass-wrapper">
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
				<li class="<?php echo esc_attr( ( 'basic-widgets' === $katlakit_active_tab ) ? 'active' : '' ); ?>" data-tab="basic-widgets"><?php esc_html_e( 'Basic Widgets', 'katlakit' ); ?></li>
				<li class="<?php echo esc_attr( ( 'creative-widgets' === $katlakit_active_tab ) ? 'active' : '' ); ?>" data-tab="creative-widgets"><?php esc_html_e( 'Creative Widgets', 'katlakit' ); ?></li>
				<li class="<?php echo esc_attr( ( 'marketing-widgets' === $katlakit_active_tab ) ? 'active' : '' ); ?>" data-tab="marketing-widgets"><?php esc_html_e( 'Marketing Widgets', 'katlakit' ); ?></li>
				<li class="<?php echo esc_attr( ( 'woo-widgets' === $katlakit_active_tab ) ? 'active' : '' ); ?>" data-tab="woo-widgets"><?php esc_html_e( 'WooCommerce', 'katlakit' ); ?></li>
				<li class="<?php echo esc_attr( ( 'extensions' === $katlakit_active_tab ) ? 'active' : '' ); ?>" data-tab="extensions"><?php esc_html_e( 'Extensions', 'katlakit' ); ?></li>
				<li class="<?php echo esc_attr( ( 'header-footer' === $katlakit_active_tab ) ? 'active' : '' ); ?>" data-tab="header-footer"><?php esc_html_e( 'Header & Footer', 'katlakit' ); ?></li>
				<li class="katlakit-pro-tab <?php echo esc_attr( ( 'license' === $katlakit_active_tab ) ? 'active' : '' ); ?>" data-tab="license"><?php esc_html_e( 'License', 'katlakit' ); ?></li>
				<li class="<?php echo esc_attr( ( 'system' === $katlakit_active_tab ) ? 'active' : '' ); ?>" data-tab="system"><?php esc_html_e( 'System Info', 'katlakit' ); ?></li>
			</ul>
		</div>

		<div class="katlakit-content">
			<form id="katlakit-settings-form">
				<!-- Basic Widgets -->
				<div class="katlakit-tab-content <?php echo esc_attr( ( 'basic-widgets' === $katlakit_active_tab ) ? 'active' : '' ); ?>" id="tab-basic-widgets">
					<h3><?php esc_html_e( 'Basic Widgets', 'katlakit' ); ?></h3>
					<div class="katlakit-grid">
						<?php
						$katlakit_basic_widgets = [ 'advanced_heading', 'fancy_button', 'info_box', 'team_member', 'testimonial', 'pricing_table', 'dual_button' ];
						foreach ( $katlakit_basic_widgets as $katlakit_widget ) :
							$katlakit_checked = ( isset( $katlakit_settings[ "widget_$katlakit_widget" ] ) && '1' === $katlakit_settings[ "widget_$katlakit_widget" ] ) ? 'checked' : '';
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
				<div class="katlakit-tab-content <?php echo esc_attr( ( 'creative-widgets' === $katlakit_active_tab ) ? 'active' : '' ); ?>" id="tab-creative-widgets">
					<h3><?php esc_html_e( 'Creative Widgets', 'katlakit' ); ?></h3>
					<div class="katlakit-grid">
						<?php
						$katlakit_creative_widgets = [ 'image_hover_card', 'interactive_banner', 'glassmorphism_card', 'before_after_image', 'timeline', 'flip_box' ];
						foreach ( $katlakit_creative_widgets as $katlakit_widget ) :
							$katlakit_checked = ( isset( $katlakit_settings[ "widget_$katlakit_widget" ] ) && '1' === $katlakit_settings[ "widget_$katlakit_widget" ] ) ? 'checked' : '';
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
				<div class="katlakit-tab-content <?php echo esc_attr( ( 'extensions' === $katlakit_active_tab ) ? 'active' : '' ); ?>" id="tab-extensions">
					<h3><?php esc_html_e( 'Extensions', 'katlakit' ); ?></h3>
					<div class="katlakit-grid">
						<?php
						$katlakit_extensions = [ 'sticky_section', 'custom_breakpoints', 'floating_effects', 'parallax_effects', 'reading_progress_bar' ];
						foreach ( $katlakit_extensions as $katlakit_ext ) :
							$katlakit_checked = ( isset( $katlakit_settings[ "ext_$katlakit_ext" ] ) && '1' === $katlakit_settings[ "ext_$katlakit_ext" ] ) ? 'checked' : '';
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

				<!-- Marketing Widgets -->
				<div class="katlakit-tab-content <?php echo esc_attr( ( 'marketing-widgets' === $katlakit_active_tab ) ? 'active' : '' ); ?>" id="tab-marketing-widgets">
					<h3><?php esc_html_e( 'Marketing Widgets', 'katlakit' ); ?></h3>
					<div class="katlakit-grid">
						<?php
						$katlakit_marketing_widgets = [ 'countdown_timer', 'call_to_action', 'logo_carousel', 'stats_counter', 'faq_accordion' ];
						foreach ( $katlakit_marketing_widgets as $katlakit_widget ) :
							$katlakit_is_pro_widget     = in_array( $katlakit_widget, [ 'pricing_table_v2', 'dual_button_v2' ], true );
							$katlakit_checked           = ( isset( $katlakit_settings[ "widget_$katlakit_widget" ] ) && '1' === $katlakit_settings[ "widget_$katlakit_widget" ] ) ? 'checked' : '';
							$katlakit_is_locked        = $katlakit_is_pro_widget && empty( $katlakit_settings['license_key'] );
							?>
							<div class="katlakit-card <?php echo esc_attr( $katlakit_is_locked ? 'katlakit-locked' : '' ); ?>">
								<h4>
									<?php echo esc_html( ucwords( str_replace( '_', ' ', $katlakit_widget ) ) ); ?>
									<?php if ( $katlakit_is_pro_widget ) : ?>
										<span class="katlakit-pro-badge">
											<?php if ( $katlakit_is_locked ) : ?>
												<i class="fas fa-lock" style="font-size: 8px; margin-right: 3px;"></i>
											<?php endif; ?>
											PRO
										</span>
									<?php endif; ?>
								</h4>
								<label class="katlakit-switch">
									<input type="checkbox" name="settings[widget_<?php echo esc_attr( $katlakit_widget ); ?>]" value="1" <?php echo esc_attr( $katlakit_checked ); ?> <?php echo $katlakit_is_locked ? 'disabled' : ''; ?>>
									<span class="katlakit-slider"></span>
								</label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<!-- WooCommerce Widgets -->
				<div class="katlakit-tab-content <?php echo esc_attr( ( 'woo-widgets' === $katlakit_active_tab ) ? 'active' : '' ); ?>" id="tab-woo-widgets">
					<h3><?php esc_html_e( 'WooCommerce Widgets', 'katlakit' ); ?></h3>
					<div class="katlakit-grid">
						<?php
						$katlakit_woo_widgets = [ 'product_grid', 'add_to_cart_button', 'mini_cart', 'product_categories', 'product_carousel' ];
						foreach ( $katlakit_woo_widgets as $katlakit_widget ) :
							$katlakit_is_pro_widget     = in_array( $katlakit_widget, [ 'mini_cart', 'product_carousel' ], true );
							$katlakit_checked           = ( isset( $katlakit_settings[ "widget_$katlakit_widget" ] ) && '1' === $katlakit_settings[ "widget_$katlakit_widget" ] ) ? 'checked' : '';
							$katlakit_is_locked        = $katlakit_is_pro_widget && empty( $katlakit_settings['license_key'] );
							?>
							<div class="katlakit-card <?php echo esc_attr( $katlakit_is_locked ? 'katlakit-locked' : '' ); ?>">
								<h4>
									<?php echo esc_html( ucwords( str_replace( '_', ' ', $katlakit_widget ) ) ); ?>
									<?php if ( $katlakit_is_pro_widget ) : ?>
										<span class="katlakit-pro-badge">
											<?php if ( $katlakit_is_locked ) : ?>
												<i class="fas fa-lock" style="font-size: 8px; margin-right: 3px;"></i>
											<?php endif; ?>
											PRO
										</span>
									<?php endif; ?>
								</h4>
								<label class="katlakit-switch">
									<input type="checkbox" name="settings[widget_<?php echo esc_attr( $katlakit_widget ); ?>]" value="1" <?php echo esc_attr( $katlakit_checked ); ?> <?php echo $katlakit_is_locked ? 'disabled' : ''; ?>>
									<span class="katlakit-slider"></span>
								</label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<!-- License -->
				<div class="katlakit-tab-content <?php echo esc_attr( ( 'license' === $katlakit_active_tab ) ? 'active' : '' ); ?>" id="tab-license">
					<h3><?php esc_html_e( 'License Settings', 'katlakit' ); ?></h3>
					<div class="katlakit-card license-card">
						<div class="license-field">
							<label for="katlakit-license-key"><?php esc_html_e( 'License Key', 'katlakit' ); ?></label>
							<div class="license-input-wrap">
								<input type="password" id="katlakit-license-key" name="settings[license_key]" value="<?php echo esc_attr( $katlakit_settings['license_key'] ?? '' ); ?>" class="regular-text">
								<?php if ( ! empty( $katlakit_settings['license_key'] ) ) : ?>
									<span class="license-status active"><?php esc_html_e( 'Active', 'katlakit' ); ?></span>
								<?php else : ?>
									<span class="license-status inactive"><?php esc_html_e( 'Inactive', 'katlakit' ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<!-- Header Footer -->
				<div class="katlakit-tab-content <?php echo esc_attr( ( 'header-footer' === $katlakit_active_tab ) ? 'active' : '' ); ?>" id="tab-header-footer">
					<h3><?php esc_html_e( 'Header & Footer Builder', 'katlakit' ); ?></h3>
					<div class="katlakit-card">
						<div class="katlakit-setting-row">
							<div class="katlakit-setting-info">
								<h4><?php esc_html_e( 'Enable Builder', 'katlakit' ); ?></h4>
								<p><?php esc_html_e( 'Enable custom header and footer builder for your theme.', 'katlakit' ); ?></p>
							</div>
							<label class="katlakit-switch">
								<input type="checkbox" name="settings[enable_header_footer]" value="1" <?php checked( '1', $katlakit_settings['enable_header_footer'] ?? '0' ); ?>>
								<span class="katlakit-slider"></span>
							</label>
						</div>
					</div>

					<?php
					$katlakit_templates_count = wp_count_posts( 'katlakit_template' );
					$katlakit_total_templates = isset( $katlakit_templates_count->publish ) ? (int) $katlakit_templates_count->publish : 0;
					?>

					<div style="display:flex;gap:12px;margin-bottom:28px;flex-wrap:wrap;">
						<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=katlakit_template' ) ); ?>" class="button button-primary katlakit-btn">
							<?php esc_html_e( 'Manage Header Footer', 'katlakit' ); ?>
						</a>
						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=katlakit_template&template_type=header' ) ); ?>" class="button button-primary katlakit-btn">
							&#43; <?php esc_html_e( 'New Header Template', 'katlakit' ); ?>
						</a>
						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=katlakit_template&template_type=before_footer' ) ); ?>" class="button button-primary katlakit-btn">
							&#43; <?php esc_html_e( 'New Before Footer Template', 'katlakit' ); ?>
						</a>
						<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=katlakit_template&template_type=footer' ) ); ?>" class="button button-primary katlakit-btn">
							&#43; <?php esc_html_e( 'New Footer Template', 'katlakit' ); ?>
						</a>
					</div>

					<div style="padding:24px;background:rgba(255,255,255,0.04);border:1px solid var(--kk-border);border-radius:10px;color:var(--kk-text);">
						<p style="margin-top:0;">
							<?php
							printf(
								/* translators: %d: number of builder templates. */
								esc_html__( 'You currently have %d published header/footer item(s).', 'katlakit' ),
								absint( $katlakit_total_templates )
							);
							?>
						</p>
						<p style="margin-bottom:0;color:var(--kk-text-muted);">
							<?php esc_html_e( 'Open the Header Footer screen to manage template type, display rules, exclusions, and Elementor editing from one place.', 'katlakit' ); ?>
						</p>
					</div>
				</div>

				<div class="katlakit-tab-content <?php echo esc_attr( ( 'system' === $katlakit_active_tab ) ? 'active' : '' ); ?>" id="tab-system">
					<h3><?php esc_html_e( 'System Status', 'katlakit' ); ?></h3>
					<table class="widefat">
						<tr><td>PHP Version</td><td><?php echo esc_html( PHP_VERSION ); ?></td></tr>
						<tr><td>WordPress Version</td><td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td></tr>
					</table>
				</div>
			</form>
		</div>
	</div>
	</div> <!-- end .katlakit-glass-wrapper -->
</div>
