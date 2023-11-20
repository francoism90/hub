<?php

namespace Foundation\Providers;

use App\Web\Videos\Components\Player;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Support\Livewire\Synthesizers\EnumSynth;
use Support\Livewire\Synthesizers\ModelSynth;
use Support\Livewire\Synthesizers\StateSynth;

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
        Livewire::propertySynthesizer(EnumSynth::class);
        Livewire::propertySynthesizer(StateSynth::class);
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
        Livewire::component('player', Player::class);
    }
}
