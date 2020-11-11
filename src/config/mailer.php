<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Lumen's queue API supports an assortment of back-ends via a single
    | API, giving you convenient access to each back-end using the same
    | syntax for every one. Here you may define a default connection.
    |
    */

    'MailJet' => [
        'driver' => env('MAIL_DRIVER'),
        'host' => env('MAIL_HOST'),
        'port' => env('MAIL_PORT'),
        'from' => [
            'address' => env('MAIL_FROM_ADDRESS'),
            'name' => env('MAIL_FROM_NAME'),
        ],
        'encryption' => env('MAIL_ENCRYPTION'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'markdown' => [
            'theme' => 'default',
            'paths' => [
                resource_path('views/vendor/mail'),
            ],
        ]
    ],
    'MailGun' => [
        'driver' => env('MAIL_DRIVER'),
        'host' => env('MAIL_HOST'),
        'port' => env('MAIL_PORT'),
        'from' => [
            'address' => env('MAIL_FROM_ADDRESS'),
            'name' => env('MAIL_FROM_NAME'),
        ],
        'encryption' => env('MAIL_ENCRYPTION'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'markdown' => [
            'theme' => 'default',
            'paths' => [
                resource_path('views/vendor/mail'),
            ],
        ]
    ]
];
