<?php

namespace MCP\App;

use MCP\App\Interfaces\WordPressHooks;

/**
 * Class Setup
 *
 * @package MCP\App
 */
class Setup implements WordPressHooks
{

    /**
     * Add class hooks.
     */
    public function addHooks()
    {
        add_action('init', [$this, 'registerMenus']);
        add_action('widgets_init', [$this, 'registerSidebars'], 5);
    }

    /**
     * Registers nav menu locations.
     */
    public function registerMenus()
    {
        register_nav_menu('primary', __('Primary', 'mc-starter-plugin'));
    }

    /**
     * Registers sidebars.
     */
    public function registerSidebars()
    {
        register_sidebar(
            [
                'id'            => 'primary',
                'name'          => __('Sidebar', 'mc-starter-plugin'),
                'description'   => __('Main sidebar area displayed on right side of page via trigger.', 'mc-starter-plugin'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
            ]
        );
    }
}
