<?php namespace Teamgrid\Task;

use Backend;
use System\Classes\PluginBase;
use Teamgrid\Task\Classes\Extend\UserExtend as UserExtend;
use Teamgrid\Task\Classes\RelationManager\UserTaskRelationManager as UserTaskRelationManager;
/**
 * Task Plugin Information File
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
            'name'        => 'Task',
            'description' => 'No description provided yet...',
            'author'      => 'teamgrid',
            'icon'        => 'icon-tasks'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        // Code to register services, bindings, etc.
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
                UserExtend::extendUser_addTasksRelation();
                UserTaskRelationManager::extendRelationManagerFields($model);
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
        return []; // Remove this line to activate

        // Example of registering a component
        /*
        return [
            'Teamgrid\Task\Components\MyComponent' => 'myComponent',
        ];
        */
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        // Example of registering permissions
        /*
        return [
            'teamgrid.task.some_permission' => [
                'tab' => 'Task',
                'label' => 'Some permission'
            ],
        ];
        */
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'task' => [
                'label'       => 'Task',
                'url'         => Backend::url('teamgrid/task/tasks'),
                'icon'        => 'icon-tasks',
                'permissions' => ['teamgrid.task.*'],
                'order'       => 500,
            ],
        ];
    }
}