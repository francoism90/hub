<?php

namespace Foundation\Providers;

use Foxws\LivewireUse\Facades\LivewireUse;
use Illuminate\Support\ServiceProvider;

class LivewireServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureComponents();
    }

    protected function configureComponents(): void
    {
        LivewireUse::registerLivewireComponents(
            path: app_path(),
            prefix: 'app'
        );
    }
}
