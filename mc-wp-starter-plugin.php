<?php
/*
Plugin Name: MC WP Starter Plugin
Plugin URI: http://modernclimaate.com
Description: A starter plugin for Modern Climate WordPress projects.
Version: 1.0.0
Author: Modern Climate
Author URI: http://modernclimate.com
Copyright: MIT
Text Domain: mc-starter-plugin
*/

use MCP\App\Core\Init;
use MCP\App\Core\Dependencies;
use MCP\App\Setup;
use MCP\App\Scripts;
use MCP\App\Media;
use MCP\App\Shortcodes;
use MCP\App\Fields\ACF;
use MCP\App\Fields\Options;
use MCP\App\Fields\FieldGroups\SiteOptionsFieldGroup;

/**
 * Define Plugin Version
 * Define Plugin directories
 */
define('MCP_PLUGIN_VERSION', '1.0.0');
define('MCP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MCP_PLUGIN_PATH_URL', trailingslashit(plugins_url('mc-wp-starter-plugin')));
define('MCP_BASE_REST_URL', home_url() . '/wp-json/mcp/v1');

require __DIR__ . '/constants.php';

// Require Autoloader
require_once MCP_PLUGIN_DIR . 'vendor/autoload.php';

// Register and check for our plugin dependencies.
$dependencies = (new Dependencies())->checkDependencies(
    __('MC WP Starter Plugin', 'mc-starter-plugin'),
    [],
    ['Advanced Custom Fields Pro' => 'advanced-custom-fields-pro/acf.php']
);

// Only continue if dependencies are present.
if (!$dependencies) {
    return false;
}

/**
 * Plugin Setup
 */
add_action('plugins_loaded', function () {

    (new Init())
        ->add(new Setup())
        ->add(new Scripts())
        ->add(new Media())
        ->add(new Shortcodes())
        ->add(new ACF())
        ->add(new Options())
        ->add(new SiteOptionsFieldGroup())
        ->initialize();

    // Translation setup
    load_plugin_textdomain('mc-starter-plugin', false, MCP_PLUGIN_DIR . '/languages');
});

// Activation hooks
register_activation_hook(__FILE__, ['MCP\App\Activation', 'activation']);

// Deactivation hooks
register_deactivation_hook(__FILE__, ['MCP\App\Activation', 'deactivation']);
