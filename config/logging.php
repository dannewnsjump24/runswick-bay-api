<?php

declare(strict_types=1);

return [

    'channels' => [
        'daily_testing' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel-testing.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
            'replace_placeholders' => true,
        ],
    ],

];
