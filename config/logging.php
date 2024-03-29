<?php

declare(strict_types=1);

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

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
