<?php

namespace Foundation\Providers;

use App\Web\Videos\Components\Similar;
use Foxws\LivewireUse\Support\Synthesizers\SpatieEnumSynth;
use Foxws\LivewireUse\Support\Synthesizers\SpatieStateSynth;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Support\Livewire\Synthesizers\ModelSynth;

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
        Livewire::propertySynthesizer(SpatieEnumSynth::class);
        Livewire::propertySynthesizer(SpatieStateSynth::class);
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
        Livewire::component('video-similar', Similar::class);
    }
}
