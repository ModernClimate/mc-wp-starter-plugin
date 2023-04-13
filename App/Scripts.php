<?php

namespace MCP\App;

use MCP\App\Interfaces\WordPressHooks;

/**
 * Class Scripts
 *
 * @package MCP\App
 */
class Scripts implements WordPressHooks
{

    const SCRIPT_HANDLE = 'mc-plugin';

    /**
     * Add class hooks.
     */
    public function addHooks()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);
    }

    /**
     * Load scripts for the front end.
     */
    public function enqueueScripts()
    {
        $handle = "{self::SCRIPT_HANDLE}-scripts";

        wp_enqueue_script(
            $handle,
            get_template_directory_uri() . "/build/scripts/plugin-scripts.min.js",
            [],
            MCP_PLUGIN_VERSION,
            true
        );

        wp_localize_script(
            $handle,
            'mcPluginData',
            [
                'appVersion' => MCP_PLUGIN_VERSION,
                'siteLocale' => get_locale(),
                'restBase'   => MCP_BASE_REST_URL,
                'svgIcons'   => $this->getPluginSVGs(),
            ]
        );
    }

    /**
     * Load stylesheets for the front end.
     */
    public function enqueueStyles()
    {
        $handle = "{self::SCRIPT_HANDLE}-styles";

        wp_enqueue_style(
            $handle,
            get_template_directory_uri() . '/build/styles/plugin-styles.min.css',
            [],
            MCP_PLUGIN_VERSION
        );
    }

    /**
     * Include global SVG file
     */
    public function getPluginSVGs()
    {
        $svg_file    = MCP_PLUGIN_DIR . 'assets/images/icons.svg';
        $svg_content = file_get_contents($svg_file);

        if ($svg_content === false) {
            return '';
        }

        return $svg_content;
    }
}
