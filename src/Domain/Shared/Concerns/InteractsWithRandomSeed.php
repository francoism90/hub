<?php

namespace Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

trait InteractsWithRandomSeed
{
    public function randomSeed(string $key, int $ttl = 60 * 30): Builder
    {
        return $this->inRandomOrder(
            static::getRandomSeed($key, $ttl)
        );
    }

    protected static function getRandomSeed(string $key, int $ttl): mixed
    {
        return Cache::remember(
            sprintf('randomSeed-%s-%s', $key, session()->getId()),
            $ttl,
            fn () => (auth()->id() ?? 0) + time()
        );
    }
}
