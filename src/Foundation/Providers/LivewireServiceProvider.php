<?php

namespace Foundation\Providers;

use App\Web\Videos\Components\Filters as VideosFilter;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureMiddlewares();
        $this->registerComponents();
    }

    protected function configureMiddlewares(): void
    {
        Livewire::addPersistentMiddleware([
            \Foundation\Http\Middlewares\RedirectIfAuthenticated::class,
            \Foundation\Http\Middlewares\Authenticate::class,
        ]);
    }

    protected function registerComponents(): void
    {
        Livewire::component('videos-filter', VideosFilter::class);
    }
}
