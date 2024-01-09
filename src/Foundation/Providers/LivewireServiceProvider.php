<?php

namespace Foundation\Providers;

use Foxws\LivewireUse\Support\Discover\LivewireScout;
use Foxws\LivewireUse\Support\Livewire\Models\ModelSynth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Stringable;
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
                    ->prepend(static::getComponentPrefix($class));

                Livewire::component($name->value(), $class->getFcqn());
            });
    }

    protected static function getComponentPrefix(DiscoveredClass $class): Stringable
    {
        return str($class->namespace)
            ->after('App\\')
            ->match('/(.*)\\\\/')
            ->kebab()
            ->finish('-');
    }
}
