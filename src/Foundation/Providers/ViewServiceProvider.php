<?php

namespace Foundation\Providers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
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
        $domains = File::directories(app_path());

        collect($domains)
            ->flatMap(fn (string $domain) => File::directories($domain))
            ->filter(fn (string $path) => File::isDirectory("{$path}/Components"))
            ->each(function (string $path) {
                // e.g. web
                $domain = basename(str($path)->beforeLast('/')->lower());

                // e.g. filters
                $key = basename(str($path)->afterLast('/')->lower());

                $namespace = str("{$path}/Components")
                    ->replaceFirst(app_path(), 'App\\')
                    ->replace('/', '\\')
                    ->trim('\\');

                Blade::componentNamespace(
                    namespace: $namespace,
                    prefix: implode('.', [$domain, $key])
                );
            });
    }

    protected function configureViews(): void
    {
        $domains = File::directories(app_path());

        collect($domains)
            ->flatMap(fn (string $domain) => File::directories($domain))
            ->filter(fn (string $path) => File::isDirectory("{$path}/Views"))
            ->each(function (string $path) {
                // e.g. web
                $domain = basename(str($path)->beforeLast('/')->lower());

                // e.g. filters
                $key = basename(str($path)->afterLast('/')->lower());

                // dd($path);

                Blade::componentNamespace(
                    namespace: $path,
                    prefix: implode('.', [$domain, $key])
                );
            });
    }
}
