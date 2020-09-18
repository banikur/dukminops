<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
    // Guard
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'perusahaan' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'user' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'hrd' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],
    //  Providers
    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],
    // Password
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],
];
