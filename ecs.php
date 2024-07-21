<?php

use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\CamelCapsFunctionNameSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withSets([__DIR__.'/vendor/jumptwentyfour/laravel-coding-standards/ecs.php'])
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/config',
        __DIR__.'/database',
        __DIR__.'/routes',
        __DIR__.'/tests',
    ])->withSkip(
        [
            'The method parameter $request is never used' => [
                __DIR__.'/app/Http/Middleware',
                __DIR__.'/app/Http/Resources',
                __DIR__.'/app/Domain/*/Resources/*.php',
                __DIR__.'/app/Exceptions/*.php',
            ],
            'Unused parameter $request.' => [
                __DIR__.'/app/Http/Middleware',
                __DIR__.'/app/Http/Resources',
                __DIR__.'/app/Domain/*/Resources/*.php',
                __DIR__.'/app/Exceptions/*.php',
            ],
            'Unused parameter $schedule.' => [
                __DIR__.'/app/Console/Kernel.php',
            ],
            'Unused parameter $e.' => [
                __DIR__.'/app/Exceptions/Handler.php',
            ],
            'The method parameter $panel is never used' => [
                __DIR__.'/app/Models/User.php',
            ],
            'Unused parameter $panel.' => [
                __DIR__.'/app/Models/User.php',
            ],
            CamelCapsFunctionNameSniff::class => [
                '/tests/**',
            ],
            'The method parameter $attributes is never used' => [
                __DIR__.'/database/factories/*.php',
            ],
            'Unused parameter $attributes.' => [
                __DIR__.'/database/factories/*.php',
            ],
            'SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff.MissingAnyTypeHint' => [
                '/tests/**',
            ],
        ]
    )->withParallel(timeoutSeconds: 800);
