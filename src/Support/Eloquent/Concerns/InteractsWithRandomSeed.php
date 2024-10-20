<?php

declare(strict_types=1);

namespace Support\Eloquent\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

trait InteractsWithRandomSeed
{
    public function scopeRandomSeed(Builder $query, string $key, int|Carbon $ttl = 300): Builder
    {
        $value = $this->getRandomSeed($key, $ttl);

        return $query
            ->selectRaw('*, setseed(?)', [$value])
            ->inRandomOrder();
    }

    public function forgetRandomSeed(string $key): mixed
    {
        return Cache::forget(
            $this->getRandomSeedKey($key)
        );
    }

    protected function getRandomSeed(string $key, int|Carbon $ttl = 300): mixed
    {
        return Cache::remember(
            $this->getRandomSeedKey($key),
            $ttl,
            fn () => round((new \Random\Randomizer())->getFloat(-1.0, 1.0), 1)
        );
    }

    protected function getRandomSeedKey(string $key): mixed
    {
        $id = auth()->id() ?: session()->getId();

        $hash = hash('crc32c', serialize([static::class, $id, $key]));

        return sprintf('randomseed-%s', $hash);
    }
}
