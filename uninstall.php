<?php
/**
 * KatlaKit Uninstall
 *
 * Fired when the plugin is uninstalled. Removes all plugin options.
 *
 * @package KatlaKit
 */

// Only run when WordPress is doing an uninstall.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove all plugin options.
delete_option( 'katlakit_settings' );
delete_option( 'katlakit_version' );
