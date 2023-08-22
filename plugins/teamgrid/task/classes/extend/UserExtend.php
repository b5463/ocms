<?php

namespace Teamgrid\Task\Classes\Extend;

use Rainlab\User\Models\User as RainLabUser;
use Teamgrid\Task\Models\Task;
use Teamgrid\Task\Classes\RelationManager\UserTaskRelationManager;

class UserExtend
{
    public static function extendUser_addTasksRelation()
    {
        RainLabUser::extend(function ($model) {
            $model->hasMany['assignedTasks'] = [Task::class, 'key' => 'user_id'];
        });
    }

    public static function extendUserWithDynamicMethods()
    {
        RainLabUser::extend(function ($model) {
            $model->addDynamicMethod('getAssignedTasksOptions', function() use ($model) {
                return Task::where('user_id', $model->id)->lists('name', 'id');
            });
        });
    }
}