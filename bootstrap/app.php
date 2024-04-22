<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

$basePath = $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__);

$app = Application::configure(basePath: $basePath)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        channels: __DIR__.'/../routes/channels.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('dashboard')
                ->name('dashboard.')
                ->group(base_path('routes/dashboard.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: ['127.0.0.1']);
        $middleware->statefulApi();
        $middleware->redirectGuestsTo('/login');

        $middleware->alias([
            'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
            'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'private' => \Foundation\Http\Middlewares\IsPrivateSubnet::class,
            'response_cache' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands([
        \Foundation\Console\Commands\AppInstall::class,
        \Foundation\Console\Commands\AppUpdate::class,
        \Foundation\Console\Commands\AppOptimize::class,
        \Support\Scout\Commands\SyncIndexes::class,
    ])
    ->create();

$app->useAppPath($basePath.'/src/App');

return $app;
