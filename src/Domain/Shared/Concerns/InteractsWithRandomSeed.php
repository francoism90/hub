<?php

namespace Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

trait InteractsWithRandomSeed
{
    public static function bootInteractsWithRandomSeed(): void
    {
        self::randomSeed();
    }

    public static function randomSeed(int $ttl = 60 * 10): mixed
    {
        if (method_exists(static::class, 'getRandomSeedLifetime')) {
            $ttl = static::getRandomSeedLifetime();
        }

        return Cache::remember(
            self::getRandomSeedKey(static::class),
            $ttl,
            fn () => (auth()->id() ?? 0) + time()
        );
    }

    public static function getRandomSeedKey(string $class): string
    {
        return sprintf('randomSeed-%s-%s',
            class_basename($class),
            session()->getId()
        );
    }

    public function scopeInRandomSeedOrder(Builder $query): Builder
    {
        return $query->inRandomOrder(
            static::randomSeed()
        );
    }
}
