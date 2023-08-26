<?php

namespace Foundation\Providers;

use App\Web\Videos\Components\Filters as VideosFilter;
use App\Web\Videos\Components\Search as VideosSearch;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Support\Livewire\ModelSynth;

class LivewireServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureSynthesizers();
        $this->configureMiddlewares();
        $this->registerComponents();
    }

    protected function configureSynthesizers(): void
    {
        Livewire::propertySynthesizer(ModelSynth::class);
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
        Livewire::component('videos-search', VideosSearch::class);
    }
}
