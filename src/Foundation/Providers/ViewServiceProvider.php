<?php

declare(strict_types=1);

namespace Foundation\Providers;

use Foxws\WireUse\Scout\ComponentScout;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureVite();
        $this->configureSessionFlash();
        $this->registerComponents();
    }

    protected function configureVite(): void
    {
        Vite::prefetch(concurrency: 3);
    }

    protected function configureSessionFlash(): void
    {
        Flash::levels([
            'success' => 'alert-success',
            'warning' => 'alert-warning',
            'error' => 'alert-error',
        ]);
    }

    protected function registerComponents(): static
    {
        ComponentScout::create(app_path('Web'), 'App\\')->register();

        return $this;
    }
}
