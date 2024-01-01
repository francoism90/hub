<?php

namespace Foundation\Providers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Stringable;
use Spatie\StructureDiscoverer\Data\DiscoveredClass;
use Support\Discover\ComponentScout;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureSeo();
        $this->configureComponents();
    }

    protected function configureSeo(): void
    {
        SEOMeta::setTitleDefault(config('app.name'));
        SEOMeta::setRobots('noindex,nofollow');
    }

    protected function configureComponents(): static
    {
        $components = ComponentScout::create()->get();

        collect($components)
            ->each(function (DiscoveredClass $class) {
                $name = str($class->name)
                    ->kebab()
                    ->prepend(static::getComponentPrefix($class));

                logger($name->value());

                Blade::component($class->getFcqn(), $name->value());
            });

        return $this;
    }

    protected static function getComponentPrefix(DiscoveredClass $class): Stringable
    {
        return str($class->namespace)
            ->after('App\\Web\\')
            ->match('/(.*)\\\\/')
            ->kebab()
            ->finish('-');
    }
}
