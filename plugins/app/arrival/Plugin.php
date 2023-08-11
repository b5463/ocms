<?php

namespace App\Arrival;

use Backend;
use System\Classes\PluginBase;

/**
 * Arrival Plugin Information File
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
            'name'        => 'Arrival',
            'description' => 'No description provided yet...',
            'author'      => 'App',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        // Code that runs during plugin registration (optional).
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // Code that runs before handling a request (optional).
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'App\Arrival\Components\MyComponent' => 'myComponent', // Register your front-end component
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
            'app.arrival.some_permission' => [
                'tab' => 'Arrival',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        try {
            return [
                'arrival' => [
                    'label'       => 'Arrival',
                    'url'         => Backend::url('app/arrival/arrivals'),
                    'icon'        => 'icon-calendar',
                    'permissions' => ['app.arrival.*'],
                    'order'       => 500,
                ],
            ];
        } catch (\Exception $e) {
            return [];
        }
    }
    
}