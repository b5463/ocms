<?php

namespace Teamgrid\Project\Classes\RelationManager;

use Rainlab\User\Models\User as RainLabUser;
use Teamgrid\Project\Models\Project;

class UserProjectRelationManager
{
    public static function extendRelationManagerFields($model)
    {
        \Rainlab\User\Controllers\Users::extendFormFields(function ($form, $userModel, $context) use ($model) {
            if (!$userModel instanceof RainLabUser) {
                return;
            }

            $form->addTabFields([
                'assignedProjects' => [
                    'label' => 'Assigned Projects',
                    'tab' => 'Projects',
                    'type' => 'relation',
                    'nameFrom' => 'name',
                    'options' => $userModel->getAssignedProjectsOptions(),
                ],
                'managedProjects' => [
                    'label' => 'Managed Projects',
                    'tab' => 'Projects',
                    'type' => 'relation',
                    'nameFrom' => 'name',
                    'options' => $userModel->getManagedProjectsOptions(),
                ], 
            ]);
        });
    }
}