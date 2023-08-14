<?php
    return [
        'defaults' => [
            'guard' => 'api',
            'passwords' => 'users',
        ],
    
        'guards' => [
            'api' => [
                'driver' => 'jwt',
                'provider' => 'users',
                'hash' => false,
            ],
        ],
    
        'providers' => [
            'users' => [
                'driver' => 'eloquent',
                'model' => '\LibUser\Userapi\Models\User',
            ],
        ]
    ];