<?php

namespace MCP\App\Fields\FieldGroups;

use MCP\App\Interfaces\WordPressHooks;

/**
 * Class RegisterFieldGroups
 *
 * @package MCP\App\Fields
 */
abstract class RegisterFieldGroups implements WordPressHooks
{

    /**
     * Add class hooks.
     */
    public function addHooks()
    {
        add_action('acf/init', [$this, 'registerFieldGroup']);
    }

    /**
     * Register Field Group via WordPlate
     */
    abstract public function registerFieldGroup();

    /**
     * Register the fields that will be available to this Field Group.
     *
     * @return array
     */
    abstract public function getFields();
}
