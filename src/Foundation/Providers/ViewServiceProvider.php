<?php

namespace Foundation\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // ...
    }

    public function boot(): void
    {
        $this->configureComponents();
        $this->configureViews();
    }

    protected function configureComponents(): void
    {
        $items = collect([
            ['namespace' => 'App\\Web\\Layouts\\Components', 'prefix' => 'layouts'],
            ['namespace' => 'App\\Web\\Tags\\Components', 'prefix' => 'tags'],
            ['namespace' => 'App\\Web\\Videos\\Components', 'prefix' => 'videos'],
        ]);

        $items->each(fn (array $item) => Blade::componentNamespace(...$item));
    }

    protected function configureViews(): void
    {
        $items = collect([
            ['path' => app_path('Web/Layouts/Views'), 'namespace' => 'layouts'],
            ['path' => app_path('Web/Tags/Views'), 'namespace' => 'tags'],
            ['path' => app_path('Web/Videos/Views'), 'namespace' => 'videos'],
        ]);

        $items->each(fn (array $item) => $this->loadViewsFrom(...$item));
    }
}
