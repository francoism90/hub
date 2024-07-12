<?php

namespace Foundation\Providers;

use Foxws\WireUse\Facades\WireUse;
use Foxws\WireUse\Support\Livewire\LegacyModels\EloquentCollectionSynth;
use Foxws\WireUse\Support\Livewire\LegacyModels\EloquentModelSynth;
use Foxws\WireUse\Support\Livewire\Models\CollectionSynth;
use Foxws\WireUse\Support\Livewire\Models\ModelSynth;
use Foxws\WireUse\Support\Livewire\ModelStateObjects\ModelStateObjectSynth;
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
        $this->registerLivewire();
    }

    protected function configureSynthesizers(): void
    {
        app('livewire')->propertySynthesizer([
            ModelSynth::class,
            CollectionSynth::class,
            EloquentModelSynth::class,
            EloquentCollectionSynth::class,
            ModelStateObjectSynth::class,
        ]);
    }

    protected function registerLivewire(): static
    {
        WireUse::registerLivewireComponents(
            path: app_path('Web'),
            namespace: 'App\\Web\\',
            prefix: 'app',
        );

        return $this;
    }
}
