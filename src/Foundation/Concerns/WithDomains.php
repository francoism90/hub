<?php

namespace Foundation\Concerns;

use Illuminate\Support\Stringable;

trait WithDomains
{
    public static function name(string $class): string
    {
        $domain = static::domain($class)->slug();

        $prefix = static::prefix($class)->slug();

        return str($class)
            ->replace('/', '\\')
            ->afterLast('\\')
            ->slug()
            ->prepend(implode('.', [$domain, $prefix, '']));
    }

    public static function domain(string $class): Stringable
    {
        return str($class)
            ->replace('/', '\\')
            ->replace('.', '\\')
            ->after('App\\')
            ->before('\\');
    }

    public static function prefix(string $class): Stringable
    {
        $domain = static::domain($class);

        return str($class)
            ->replace('/', '\\')
            ->after("App\\{$domain}")
            ->trim('\\')
            ->before('\\');
    }

    public static function toClass(string $path): Stringable
    {
        return str($path)
            ->before('.php')
            ->replaceFirst(app_path(), 'App')
            ->replace('/', '\\')
            ->trim('\\');
    }
}
