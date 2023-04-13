<?php

namespace MCP\App\Fields\FieldGroups;

use WordPlate\Acf\Location;
use MCP\App\Fields\Options\Settings;

/**
 * Class SiteOptionsFieldGroup
 *
 * @package MCP\App\Fields\SiteOptionsFieldGroup
 */
class SiteOptionsFieldGroup extends RegisterFieldGroups
{
    /**
     * Register Field Group via Wordplate
     */
    public function registerFieldGroup()
    {
        register_extended_field_group([
            'title'    => __('Plugin Options', 'mc-starter-plugin'),
            'fields'   => $this->getFields(),
            'location' => [
                Location::if('options_page', 'mc-plugin-general-options')
            ],
            'style' => 'default'
        ]);
    }

    /**
     * Register the fields that will be available to this Field Group.
     *
     * @return array
     */
    public function getFields()
    {
        return apply_filters(
            'mcp/field-group/site-options/fields',
            array_merge(
                (new Settings())->fields()
            )
        );
    }
}
