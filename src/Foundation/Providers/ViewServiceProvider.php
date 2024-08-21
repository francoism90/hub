<?php

namespace Foundation\Providers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureVite();
        $this->configureSeo();
        $this->configureMessages();
    }

    protected function configureVite(): void
    {
        Vite::useWaterfallPrefetching(concurrency: 10);
    }

    protected function configureSeo(): void
    {
        SEOMeta::setTitleDefault(config('app.name'));
        SEOMeta::setRobots('noindex,nofollow');
    }

    protected function configureMessages(): void
    {
        Flash::levels([
            'success' => 'alert-success',
            'warning' => 'alert-warning',
            'error' => 'alert-error',
        ]);
    }
}
