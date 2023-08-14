<?php namespace App\PostmanPlugin;

use Backend;
use System\Classes\PluginBase;

/**
 * PostmanPlugin Plugin Information File
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
            'name'        => 'PostmanPlugin',
            'description' => 'No description provided yet...',
            'author'      => 'app',
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

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        \App\Arrival\Models\Arrival::extend(function ($arrival)
        {
            $arrival->bindEvent('model.afterCreate', function () use ( $arrival) {
                \Log::info("Arrival created: Name - {$arrival->name}, Arrival - {$arrival->arrival}");
            });
        }); 
    }
}
