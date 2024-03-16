<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$basePath = $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__);

$app = Application::configure(basePath: $basePath)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();

        $middleware->alias([
            'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
            'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'private' => \Foundation\Http\Middlewares\IsPrivateSubnet::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        ]);

        $middleware->redirectGuestsTo('/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

$app->useAppPath($basePath.'/src/App');

return $app;
