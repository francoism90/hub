<?php

namespace Foundation\Providers;

use Foxws\LivewireUse\Support\Discover\LivewireScout;
use Foxws\LivewireUse\Support\Livewire\Models\ModelSynth;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Spatie\StructureDiscoverer\Data\DiscoveredClass;

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
        $components = LivewireScout::create()
            ->path(app_path())
            ->prefix('livewire-components')
            ->get();

        collect($components)
            ->each(function (DiscoveredClass $class) {
                $name = str($class->name)
                    ->kebab()
                    ->prepend(LivewireScout::componentPrefix($class));

                Livewire::component($name->value(), $class->getFcqn());
            });
    }
}
