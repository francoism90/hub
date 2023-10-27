<?php

namespace Foundation\Providers;

use Domain\Media\Models\Media;
use Domain\Playlists\Models\Playlist;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    public const HOME = '/';

    public function boot(): void
    {
        $this->configureModelBinding();
        $this->configureRateLimiting();
        $this->configureRoutes();
    }

    protected function configureModelBinding(): void
    {
        Route::bind('media', fn (string $value) => Media::findByUuidOrFail($value));
        Route::bind('playlist', fn (string $value) => Playlist::findByPrefixedIdOrFail($value));
        Route::bind('tag', fn (string $value) => Tag::findByPrefixedIdOrFail($value));
        Route::bind('user', fn (string $value) => User::findByPrefixedIdOrFail($value));
        Route::bind('video', fn (string $value) => Video::findByPrefixedIdOrFail($value));
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(1000)->by($request->user()?->getKey() ?: $request->ip());
        });
    }

    protected function configureRoutes(): void
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/auth.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
