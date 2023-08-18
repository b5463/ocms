<?php

namespace Teamgrid\Project;

use Backend;
use System\Classes\PluginBase;

/**
 * Project Plugin Information File
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
            'name'        => 'Project',
            'description' => 'No description provided yet...',
            'author'      => 'teamgrid',
            'icon'        => 'icon-briefcase'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        // Any additional registration logic can be placed here
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // Any boot-up logic can be placed here
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            // 'Teamgrid\Project\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            // 'teamgrid.project.some_permission' => [
            //     'tab' => 'Project',
            //     'label' => 'Some permission'
            // ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'project' => [
                'label'       => 'Project',
                'url'         => Backend::url('teamgrid/project/Projects'),
                'icon'        => 'icon-briefcase',
                'permissions' => ['teamgrid.project.*'],
                'order'       => 500,
            ],
        ];
    }
}