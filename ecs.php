<?php

use JumpTwentyFour\PhpCodingStandards\Support\ConfigHelper;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\CamelCapsFunctionNameSniff;
use SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->import(__DIR__.'/vendor/jumptwentyfour/laravel-coding-standards/ecs.php');

    $parameters = $ecsConfig->parameters();

    $parameters->set(Option::PATHS, [
        __DIR__.'/app',
        __DIR__.'/config',
        __DIR__.'/database',
        __DIR__.'/routes',
        __DIR__.'/tests',
    ]);

    $parameters->set(Option::SKIP, array_merge(ConfigHelper::make($ecsConfig)->getParameter(Option::SKIP), [
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
        CamelCapsFunctionNameSniff::class => [
            '/tests/**',
        ],
        'Unused parameter $attributes.' => [
            __DIR__.'/database/factories/*.php',
        ],
        'SlevomatCodingStandard\Sniffs\TypeHints\ReturnTypeHintSniff.MissingAnyTypeHint' => [
            '/tests/**',
        ],
    ]));
};
