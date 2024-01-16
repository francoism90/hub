<?php

namespace Foundation\Providers;

use Foxws\LivewireUse\Facades\LivewireUse;
use Foxws\LivewireUse\Support\Livewire\Models\ModelSynth;
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
        $this->configureSynthesizers();
        $this->configureMiddlewares();
        $this->configureComponents();
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

    protected function configureComponents(): void
    {
        LivewireUse::registerLivewireComponents(
            path: app_path(),
            prefix: 'livewire-components'
        );
    }
}
