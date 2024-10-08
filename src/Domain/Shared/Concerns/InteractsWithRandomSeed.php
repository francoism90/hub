<?php

namespace Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

trait InteractsWithRandomSeed
{
    public function scopeRandomSeed(Builder $query, string $key, int|Carbon $ttl = 300): Builder
    {
        return $query
            ->reorder()
            ->inRandomOrder($this->getRandomSeed($key, $ttl));
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
            fn () => time()
        );
    }

    protected function getRandomSeedKey(string $key): mixed
    {
        $id = auth()->id() ?: session()->getId();

        $hash = hash('crc32c', serialize([$key, $id]));

        return sprintf('randomseed-%s', $hash);
    }
}
