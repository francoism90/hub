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

    protected function getRandomSeed(string $key, int|Carbon $ttl = 300): mixed
    {
        return Cache::remember(
            $this->getRandomSeedKey($key),
            $ttl,
            fn () => time()
        );
    }

    protected function forgetRandomSeed(string $key): mixed
    {
        return Cache::forget(
            $this->getRandomSeedKey($key)
        );
    }

    protected function getRandomSeedKey(string $key): mixed
    {
        $id = auth()->id() ?: session()->getId();

        return sprintf('randomSeed-%s-%s', $id, $key);
    }
}
