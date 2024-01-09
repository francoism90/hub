<?php

namespace Foundation\Providers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Foxws\LivewireUse\Support\Discover\ComponentScout;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Spatie\StructureDiscoverer\Data\DiscoveredClass;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureSeo();
        $this->configureComponents();
        $this->configurePaginators();
    }

    protected function configureSeo(): void
    {
        SEOMeta::setTitleDefault(config('app.name'));
        SEOMeta::setRobots('noindex,nofollow');
    }

    protected function configureComponents(): void
    {
        $components = ComponentScout::create()
            ->path(app_path())
            ->prefix('components')
            ->get();

        collect($components)
            ->each(function (DiscoveredClass $class) {
                $name = str($class->name)
                    ->kebab()
                    ->prepend(ComponentScout::componentPrefix($class));

                Blade::component($class->getFcqn(), $name->value());
            });
    }

    protected function configurePaginators(): void
    {
        Paginator::defaultView('pagination.default');

        Paginator::defaultSimpleView('pagination.simple');
    }


}
