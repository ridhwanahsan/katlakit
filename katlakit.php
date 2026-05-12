<?php
/**
 * Plugin Name: KatlaKit
 * Plugin URI:  https://wordpress.org/plugins/katlakit/
 * Description: Advanced Elementor Addon Widgets & Extensions Toolkit.
 * Version:     1.0.0
 * Author:      ruivocode
 * Author URI:  https://wordpress.org/plugins/katlakit/
 * Text Domain: katlakit
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package KatlaKit
 */

// Prevent direct access.
if (!defined('ABSPATH')) {
	exit;
}

// ── Plugin Constants ──────────────────────────────────────────────────────────
defined('KATLAKIT_VERSION') || define('KATLAKIT_VERSION', '1.0.0');
defined('KATLAKIT_FILE') || define('KATLAKIT_FILE', __FILE__);
defined('KATLAKIT_PATH') || define('KATLAKIT_PATH', plugin_dir_path(__FILE__));
defined('KATLAKIT_URL') || define('KATLAKIT_URL', plugin_dir_url(__FILE__));
defined('KATLAKIT_ASSETS_URL') || define('KATLAKIT_ASSETS_URL', KATLAKIT_URL . 'assets/');
defined('KATLAKIT_ASSETS_PATH') || define('KATLAKIT_ASSETS_PATH', KATLAKIT_PATH . 'assets/');
defined('KATLAKIT_INC_PATH') || define('KATLAKIT_INC_PATH', KATLAKIT_PATH . 'includes/');
defined('KATLAKIT_MINIMUM_ELEMENTOR_VERSION') || define('KATLAKIT_MINIMUM_ELEMENTOR_VERSION', '3.10.0');
defined('KATLAKIT_MINIMUM_PHP_VERSION') || define('KATLAKIT_MINIMUM_PHP_VERSION', '7.4');

// ── Autoloader ────────────────────────────────────────────────────────────────
/**
 * PSR-4 style autoloader mapping KatlaKit\ namespace to /includes/.
 *
 * @param string $class Fully qualified class name.
 */
spl_autoload_register(function ($class) {
	$prefix = 'KatlaKit\\';
	$len = strlen($prefix);

	if (strncmp($prefix, $class, $len) !== 0) {
		return;
	}

	$relative_class = substr($class, $len);
	$file = KATLAKIT_INC_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $relative_class) . '.php';

	$special_module_files = [
		'Modules\\Header_Footer' => KATLAKIT_INC_PATH . 'modules/header-footer/Module.php',
		'Modules\\KK_HF_Document' => KATLAKIT_INC_PATH . 'modules/header-footer/Document.php',
	];

	if (isset($special_module_files[$relative_class]) && file_exists($special_module_files[$relative_class])) {
		require_once $special_module_files[$relative_class];
		return;
	}

	if (file_exists($file)) {
		require_once $file;
		return;
	}

	// Support modular widget directories (e.g. basic/advanced-heading/Advanced_Heading.php)
	if (strpos($relative_class, 'Widgets\\') === 0) {
		$parts = explode('\\', $relative_class);
		if (count($parts) === 3) {
			$category = strtolower($parts[1]);
			$class_name = $parts[2];
			$slug = strtolower(str_replace('_', '-', $class_name));
			$widget_file = KATLAKIT_INC_PATH . 'widgets/' . $category . '/' . $slug . '/' . $class_name . '.php';
			if (file_exists($widget_file)) {
				require_once $widget_file;
			}
		}
	}
});

// ── Bootstrap ─────────────────────────────────────────────────────────────────
/**
 * Init Admin panel early so it's always accessible.
 */
if (is_admin()) {
	new \KatlaKit\Admin\Admin();
}

/**
 * Entry point – runs after all plugins are loaded so we can safely
 * detect Elementor.
 */
function katlakit_init()
{
	// PHP version check.
	if (version_compare(PHP_VERSION, KATLAKIT_MINIMUM_PHP_VERSION, '<')) {
		add_action('admin_notices', 'katlakit_notice_php_version');
		return;
	}

	// Elementor check.
	if (!did_action('elementor/loaded')) {
		add_action('admin_notices', 'katlakit_notice_elementor_missing');
		return;
	}

	// Elementor version check.
	if (!version_compare(ELEMENTOR_VERSION, KATLAKIT_MINIMUM_ELEMENTOR_VERSION, '>=')) {
		add_action('admin_notices', 'katlakit_notice_elementor_version');
		return;
	}

	// Fire up the singleton.
	\KatlaKit\Plugin::instance();
}
add_action('plugins_loaded', 'katlakit_init', 99);

// ── Admin Notices ─────────────────────────────────────────────────────────────

/** Notice: PHP version too low. */
function katlakit_notice_php_version()
{
	$message = sprintf(
		/* translators: 1: Plugin name, 2: Required PHP version, 3: Current PHP version. */
		esc_html__('%1$s requires PHP version %2$s or higher. Your current PHP version is %3$s. Please update PHP.', 'katlakit'),
		'<strong>KatlaKit</strong>',
		KATLAKIT_MINIMUM_PHP_VERSION,
		PHP_VERSION
	);
	printf('<div class="notice notice-error"><p>%s</p></div>', wp_kses_post($message));
}

/** Notice: Elementor not installed / activated. */
function katlakit_notice_elementor_missing()
{
	$install_url = esc_url(admin_url('plugin-install.php?s=Elementor&tab=search&type=term'));
	$message = sprintf(
		/* translators: 1: Plugin name, 2: Elementor link. */
		__('%1$s requires %2$s to be installed and activated.', 'katlakit'),
		'<strong>KatlaKit</strong>',
		'<a href="' . $install_url . '"><strong>Elementor</strong></a>'
	);
	printf('<div class="notice notice-warning"><p>%s</p></div>', wp_kses_post($message));
}

/** Notice: Elementor version too old. */
function katlakit_notice_elementor_version()
{
	$message = sprintf(
		/* translators: 1: Plugin name, 2: Required Elementor version. */
		esc_html__('%1$s requires Elementor version %2$s or higher. Please update Elementor.', 'katlakit'),
		'<strong>KatlaKit</strong>',
		KATLAKIT_MINIMUM_ELEMENTOR_VERSION
	);
	printf('<div class="notice notice-warning"><p>%s</p></div>', wp_kses_post($message));
}

// ── Activation / Deactivation ─────────────────────────────────────────────────
register_activation_hook(__FILE__, 'katlakit_activate');
register_deactivation_hook(__FILE__, 'katlakit_deactivate');

/** Plugin activation tasks. */
function katlakit_activate()
{
	if (!get_option('katlakit_settings')) {
		$defaults = require KATLAKIT_INC_PATH . 'config/settings.php';
		update_option('katlakit_settings', $defaults, false);
	}
	update_option('katlakit_version', KATLAKIT_VERSION, false);
}

/** Plugin deactivation tasks. */
function katlakit_deactivate()
{
	// Nothing destructive – settings are preserved until uninstall.
}
