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
        Blade::componentNamespace('App\\Web\\Videos\\Components', 'videos');
    }

    protected function configureViews(): void
    {
        $this->loadViewsFrom(app_path('Web\Videos\Views'), 'videos');
    }
}
