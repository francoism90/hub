<?php

namespace Foundation\Providers;

use Foxws\LivewireUse\Facades\LivewireUse;
use Foxws\LivewireUse\Support\Livewire\Models\EloquentModelSynth;
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
        $this->configureComponents();
    }

    protected function configureSynthesizers(): void
    {
        Livewire::propertySynthesizer(ModelSynth::class);
        Livewire::propertySynthesizer(EloquentModelSynth::class);
    }

    protected function configureComponents(): void
    {
        LivewireUse::registerLivewireComponents(
            path: app_path(),
            prefix: 'app'
        );
    }
}
