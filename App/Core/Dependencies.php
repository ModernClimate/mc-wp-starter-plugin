<?php

namespace MCP\App\Core;

/**
 * Class Dependencies
 *
 * Pass file and plugin dependencies to checkDependencies to ensure that the proper files exist and the plugins
 * are activated on the site. If we are missing a dependency, display an admin notice in the dashboard.
 *
 * @package MCP\App\Core
 */
class Dependencies
{

    /**
     * array of admin messages
     * @var array
     */
    private $messages = [];

    /**
     * Hook into admin notices to display warning messages
     */
    public function addHooks()
    {
        add_action('admin_notices', [$this, 'displayAdminNotices']);
    }

    /**
     * Check that we have the dependencies for the plugin.
     *
     * @param string $plugin_name the plugin name that requires these dependencies
     * @param array $files containing plugin file dependencies to check
     * @param array $plugins containing plugin dependencies to check
     *
     * @return bool true if dependencies exist
     */
    public function checkDependencies($plugin_name = 'MC WP Starter Plugin', array $files = [], array $plugins = [])
    {

        // include plugin file so we can check if plugin is active
        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        foreach ($files as $label => $file_path) {
            if (!file_exists($file_path)) {
                $this->messages[] = sprintf(__('<strong>%1$s:</strong> This plugin requires that %2$s be installed.', 'mc-starter-plugin'), $plugin_name, $label);

                $this->addHooks();

                return false;
            }
        }

        foreach ($plugins as $label => $plugin) {
            if (!is_plugin_active_for_network($plugin) && !is_plugin_active($plugin)) {
                $this->messages[] = sprintf(__('<strong>%1$s:</strong> This plugin requires that %2$s be installed.', 'mc-starter-plugin'), $plugin_name, $label);

                $this->addHooks();

                return false;
            }
        }

        return true;
    }

    /**
     * Loop through messages array and display them on the admin page
     */
    public function displayAdminNotices()
    {
        foreach ((array) $this->messages as $message) {
            // If we're missing any dependencies, output the error message
            echo '<div class="notice notice-error"><p>' . $message . '</p></div>';

            // Removes "plugin activated" message
            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }
        }
    }
}
