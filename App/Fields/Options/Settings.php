<?php

namespace MCP\App\Fields\Options;

use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Image;

/**
 * Class Settings
 *
 * @package MCP\App\Fields\Options
 */
class Settings
{
    /**
     * Defines fields used within Options tab.
     *
     * @return array
     */
    public function fields()
    {
        return apply_filters(
            'mcp/options/branding',
            [
                Tab::make(__('Settings', 'mc-starter-plugin'))
                    ->placement('left'),
                Image::make(__('Some Image', 'mc-starter-plugin'), 'some-image')
                    ->returnFormat('array')
                    ->previewSize('thumbnail')
            ]
        );
    }
}
