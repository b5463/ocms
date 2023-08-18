<?php

namespace Teamgrid\TimeEntry;

use Backend;
use System\Classes\PluginBase;

/**
 * TimeEntry Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'TimeEntry',
            'description' => 'No description provided yet...',
            'author'      => 'teamgrid',
            'icon'        => 'icon-clock-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        // Plugin registration logic if needed
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {
        // Plugin boot logic if needed
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'timeentry' => [
                'label'       => 'Time Entry',
                'url'         => Backend::url('teamgrid/timeentry/timeentries'),
                'icon'        => 'icon-clock-o',
                'permissions' => ['teamgrid.timeentry.*'],
                'order'       => 500,
            ],
        ];
    }
}