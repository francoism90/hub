<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Spatie\PrefixedIds\Exceptions\NoPrefixedModelFound;

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
                ->group(__DIR__.'/../routes/shared.php');
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        $middleware->throttleWithRedis();
        $middleware->statefulApi();
        $middleware->redirectGuestsTo('/login');

        $middleware->alias([
            'abilities' => \Laravel\Sanctum\Http\Middleware\CheckAbilities::class,
            'ability' => \Laravel\Sanctum\Http\Middleware\CheckForAnyAbility::class,
            'cache' => \Foundation\Http\Middlewares\SetCacheHeaders::class,
            'private' => \Foundation\Http\Middlewares\EnsureRequestHasPrivateSubnet::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'response_cache' => \Spatie\ResponseCache\Middlewares\CacheResponse::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'subscribed' => \App\Api\Users\Middlewares\EnsureUserHasSubscription::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->dontReport([
            NoPrefixedModelFound::class,
        ]);

        $exceptions->render(fn (NoPrefixedModelFound $e) => abort(404));
    })
    ->withCommands([
        \Foundation\Console\Commands\AppInstall::class,
        \Foundation\Console\Commands\AppUpdate::class,
        \Foundation\Console\Commands\AppOptimize::class,
        \Support\Scout\Commands\SyncIndexes::class,
        \Support\Structures\Commands\RefreshStructures::class,
        \Domain\Tags\Commands\CreateTag::class,
        \Domain\Tags\Commands\SortTags::class,
        \Domain\Users\Commands\CreateUser::class,
        \Domain\Videos\Commands\CleanVideos::class,
        \Domain\Videos\Commands\ImportVideos::class,
        \Domain\Videos\Commands\RegenerateVideos::class,
    ])
    ->create();

$app->useAppPath($basePath.'/src/App');

return $app;
