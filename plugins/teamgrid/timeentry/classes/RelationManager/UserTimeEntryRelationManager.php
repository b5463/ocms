<?php

namespace Teamgrid\TimeEntry\Classes\RelationManager;

use Rainlab\User\Models\User as RainLabUser;
use Teamgrid\TimeEntry\Models\TimeEntry;

class UserTimeEntryRelationManager
{
    public static function extendRelationManagerFields($userModel)
    {
        \Rainlab\User\Controllers\Users::extendFormFields(function ($form, $model, $context) use ($userModel) {
            if (!$model instanceof RainLabUser) {
                return;
            }

            $form->addTabFields([
                'timeEntries' => [
                    'label' => 'Time Entries',
                    'tab' => 'Time Entries',
                    'type' => 'relation',
                    'nameFrom' => 'total_time',
                    'options' => $userModel->getTimeEntriesOptions(),
                ],
            ]);
        });
    }
}