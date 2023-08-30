<?php

namespace Foundation\Providers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Foundation\Concerns\WithDomains;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Component;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ViewServiceProvider extends ServiceProvider
{
    use WithDomains;

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
        $files = (new Finder)
            ->in(app_path())
            ->files()
            ->name('*.php');

        collect($files)
            ->map(fn (SplFileInfo $file) => static::toClass($file->getRealPath()))
            ->filter(fn (string $class) => is_a($class, Component::class, true))
            ->each(function (string $class) {
                $domain = static::domain($class);

                $prefix = static::prefix($class);

                $prefix = static::name($class);

                dd($prefix);

                // dd($domain);

                // dd($class);

                $namespace = str($class)
                    ->after("\\{$domain}\\")
                    ->before('\\');

                dd($namespace);
            });

            // ->filter(fn (string $path) =>
            // ->each(function (string $path) {
            //     dd($path);


                //

                // // e.g. web
                // $domain = basename(str($path)->beforeLast('/')->lower());

                // // e.g. filters
                // $key = basename(str($path)->afterLast('/')->lower());

                // $namespace = str("{$path}/Components")
                //     ->replaceFirst(app_path(), 'App\\')
                //     ->replace('/', '\\')
                //     ->trim('\\');

                // Blade::componentNamespace(
                //     namespace: $namespace,
                //     prefix: implode('.', [$domain, $key])
                // );
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
