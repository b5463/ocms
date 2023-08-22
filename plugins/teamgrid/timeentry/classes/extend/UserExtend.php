<?php

namespace Teamgrid\TimeEntry\Classes\Extend;

use Rainlab\User\Models\User as RainLabUser;
use Teamgrid\TimeEntry\Models\TimeEntry;
class UserExtend
{
    public static function extendUser_addTimeEntriesRelation()
    {
        RainLabUser::extend(function ($model) {
            $model->hasMany['timeEntries'] = [TimeEntry::class, 'key' => 'user_id'];
        });
    }

    public static function extendUserWithDynamicMethods()
    {
        RainLabUser::extend(function ($model) {
            $model->addDynamicMethod('getTimeEntriesOptions', function() use ($model) {
                return TimeEntry::where('user_id', $model->id)->lists('user_name', 'id');
            });
        });
    }
}