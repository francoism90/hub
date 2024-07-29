<?php

namespace Foundation\Providers;

use Foxws\WireUse\Scout\LivewireScout;
use Foxws\WireUse\Support\Livewire\LegacyModels\EloquentCollectionSynth;
use Foxws\WireUse\Support\Livewire\LegacyModels\EloquentModelSynth;
use Foxws\WireUse\Support\Livewire\Models\CollectionSynth;
use Foxws\WireUse\Support\Livewire\Models\ModelSynth;
use Foxws\WireUse\Support\Livewire\ModelStateObjects\ModelStateObjectSynth;
use Illuminate\Support\ServiceProvider;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerSynthesizers();
        $this->registerLivewire();
    }

    protected function registerSynthesizers(): void
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
        LivewireScout::create(app_path('Web'), 'App\\')->register();

        return $this;
    }
}
