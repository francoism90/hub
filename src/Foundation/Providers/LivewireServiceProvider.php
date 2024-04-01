<?php

namespace Foundation\Providers;

use Foxws\LivewireUse\Facades\LivewireUse;
use Foxws\LivewireUse\Support\Livewire\LegacyModels\EloquentCollectionSynth;
use Foxws\LivewireUse\Support\Livewire\LegacyModels\EloquentModelSynth;
use Foxws\LivewireUse\Support\Livewire\Models\CollectionSynth;
use Foxws\LivewireUse\Support\Livewire\Models\ModelSynth;
use Illuminate\Support\ServiceProvider;

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
        app('livewire')->propertySynthesizer([
            ModelSynth::class,
            CollectionSynth::class,
            EloquentModelSynth::class,
            EloquentCollectionSynth::class
        ]);
    }

    protected function configureComponents(): void
    {
        LivewireUse::registerLivewireComponents(
            path: app_path(),
            prefix: 'app'
        );
    }
}
