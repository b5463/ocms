<?php

namespace Teamgrid\Project;

use Backend;
use System\Classes\PluginBase;
use Teamgrid\Project\Classes\Extend\UserExtend as UserExtend;
use Teamgrid\Project\Classes\RelationManager\UserProjectRelationManager as UserProjectRelationManager;

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
        try {
            $userModel = \RainLab\User\Models\User::class;
            UserExtend::extendUserWithDynamicMethods();
            $userModel::extend(function ($model) {
                UserExtend::extendUser_addProjectsRelation();
                UserProjectRelationManager::extendRelationManagerFields($model);
            });
        } catch (\Exception $e) {
            \Log::error('An error occurred in plugin boot: ' . $e->getMessage());
        }
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