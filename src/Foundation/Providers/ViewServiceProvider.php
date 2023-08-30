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
        // $this->configureComponents();
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

        $components = collect($files)
            ->map(fn (SplFileInfo $file) => static::toClass($file->getRealPath()))
            ->filter(fn (string $class) => is_a($class, Component::class, true))
            ->mapWithKeys(fn (string $class) => [static::name($class) => $class]);

        $this->loadViewComponentsAs('', $components->all());
    }

    protected function configureViews(): void
    {
        $files = (new Finder)
            ->in(app_path())
            ->files()
            ->name('*.blade.php');

        $views = collect($files)
            ->mapWithKeys(fn (SplFileInfo $file) => [$file->getPath() => static::name($file->getPath())]);
            // ->mapWithKeys(fn (string $class) => [static::name($class) => $class]);

        dd($views);

        // $this->loadViewsFrom('', $components->all());
    }


}
