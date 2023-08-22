<?php

namespace Teamgrid\Task\Classes\RelationManager;

use Rainlab\User\Models\User as RainLabUser;
use Teamgrid\Task\Models\Task;

class UserTaskRelationManager
{
    public static function extendRelationManagerFields($userModel)
    {
        \Rainlab\User\Controllers\Users::extendFormFields(function ($form, $model, $context) use ($userModel) {
            if (!$model instanceof RainLabUser) {
                return;
            }

            $form->addTabFields([
                'assignedTasks' => [
                    'label' => 'Assigned Tasks',
                    'tab' => 'Tasks',
                    'type' => 'relation',
                    'nameFrom' => 'name',
                    'options' => $model->getAssignedTasksOptions(),
                ],
            ]);
        });
    }
}