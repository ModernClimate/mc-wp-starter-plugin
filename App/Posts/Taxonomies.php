<?php

namespace MCP\App\Posts;

/**
 * Class Taxonomies
 *
 * @package MCP\App\Posts
 */
class Taxonomies
{

    /**
     * Taxonomies constructor.
     *
     * Example Usage:
     *
     * Taxonomies::registerTaxonomy(
     *     'location',
     *     __( 'Location', 'mc-starter-plugin' ),
     *     __( 'Locations', 'mc-starter-plugin' ),
     *     [ 'project' ]
     * );
     *
     * @param $slug
     * @param $singular
     * @param $plural
     * @param array $types Object type or array of object types
     * @param array $args
     */
    public static function registerTaxonomy($slug, $singular, $plural, $types = [], $args = [])
    {
        $labels = [
            'name'              => $plural,
            'singular_name'     => $singular,
            'menu_name'         => $plural,
            'search_items'      => sprintf(__('Search %1$s', 'mc-starter-plugin'), $plural),
            'all_items'         => sprintf(__('All %1$s', 'mc-starter-plugin'), $plural),
            'parent_item'       => sprintf(__('Parent %1$s', 'mc-starter-plugin'), $singular),
            'parent_item_colon' => sprintf(__('Parent %1$s:', 'mc-starter-plugin'), $singular),
            'edit_item'         => sprintf(__('Edit %1$s', 'mc-starter-plugin'), $singular),
            'update_item'       => sprintf(__('Update %1$s', 'mc-starter-plugin'), $singular),
            'add_new_item'      => sprintf(__('Add New %1$s', 'mc-starter-plugin'), $singular),
            'new_item_name'     => sprintf(__('New %1$s Name', 'mc-starter-plugin'), $singular)
        ];

        $defaults = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true
        ];

        register_taxonomy($slug, $types, wp_parse_args($args, $defaults));
    }
}
