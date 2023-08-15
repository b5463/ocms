<?php

namespace App\Arrival;

use Backend;
use System\Classes\PluginBase;
use RainLab\User\Models\User as RainLabUser;

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
        RainLabUser::extend(function ($model) {
            // Add the $hasMany relationship to the Arrival model
            $model->hasMany['arrivals'] = ['App\Arrival\Models\Arrival', 'key' => 'user_id'];
        });
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
                    'icon'        => 'icon-clock-o',
                    'permissions' => ['app.arrival.*'],
                    'order'       => 500,
                ],
            ];
        } catch (\Exception $e) {
            return [];
        }
    }
    
}