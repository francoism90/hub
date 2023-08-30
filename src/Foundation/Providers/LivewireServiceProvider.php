<?php

namespace Foundation\Providers;

use App\Web\Layouts\Components\Search as LayoutSearch;
use App\Web\Videos\Components\Filters as VideoFilters;
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
        Livewire::component('layout-search', LayoutSearch::class);
        Livewire::component('video-filters', VideoFilters::class);
    }
}
