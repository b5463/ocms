<?php

namespace App\Arrival\Classes\Extend;

use RainLab\User\Models\User as RainLabUser;

class UserExtend
{
    public static function extendUser_addArrivalsRelation()
    {
        RainLabUser::extend(function ($model) {
            $model->hasMany['arrivals'] = ['App\Arrival\Models\Arrival', 'key' => 'user_id'];
        });
    }
}