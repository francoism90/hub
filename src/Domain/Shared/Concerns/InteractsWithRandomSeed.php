<?php

namespace Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait InteractsWithRandomSeed
{
    public function scopeRandomSeed(Builder $query, string $key, Carbon|int $ttl = 60 * 60): Builder
    {
        return $query
            ->reorder()
            ->inRandomOrder(static::getRandomSeed($key, $ttl));
    }

    protected static function getRandomSeed(string $key, Carbon|int $ttl): mixed
    {
        return cache()->remember(
            static::getRandomSeedKey($key),
            $ttl,
            fn () => time()
        );
    }

    protected static function forgetRandomSeed(string $key): mixed
    {
        return cache()->forget(
            static::getRandomSeedKey($key)
        );
    }

    protected static function getRandomSeedKey(string $key): mixed
    {
        $id = auth()->id() ?: session()->getId();

        return sprintf('randomSeed-%s-%s', $id, $key);
    }
}
