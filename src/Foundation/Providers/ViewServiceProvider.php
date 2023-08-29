<?php

namespace Foundation\Providers;

use Artesaos\SEOTools\Facades\SEOMeta;
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
        $this->configureSeo();
        $this->configureComponents();
        $this->configureViews();
    }

    protected function configureSeo(): void
    {
        SEOMeta::setTitleDefault(config('app.name'));
        SEOMeta::setRobots('noindex,nofollow');
    }

    protected function configureComponents(): void
    {
        $items = collect([
            ['namespace' => 'App\\Web\\Layouts\\Components', 'prefix' => 'layouts'],
            ['namespace' => 'App\\Web\\Account\\Components', 'prefix' => 'account'],
            ['namespace' => 'App\\Web\\Tags\\Components', 'prefix' => 'tags'],
            ['namespace' => 'App\\Web\\Videos\\Components', 'prefix' => 'videos'],
            ['namespace' => 'App\\Web\\Playlists\\Components', 'prefix' => 'playlists'],
        ]);

        $items->each(fn (array $item) => Blade::componentNamespace(...$item));
    }

    protected function configureViews(): void
    {
        $items = collect([
            ['path' => app_path('Web/Layouts/Views'), 'namespace' => 'layouts'],
            ['path' => app_path('Web/Account/Views'), 'namespace' => 'account'],
            ['path' => app_path('Web/Tags/Views'), 'namespace' => 'tags'],
            ['path' => app_path('Web/Videos/Views'), 'namespace' => 'videos'],
            ['path' => app_path('Web/Playlists/Views'), 'namespace' => 'playlists'],
        ]);

        $items->each(fn (array $item) => $this->loadViewsFrom(...$item));
    }
}
