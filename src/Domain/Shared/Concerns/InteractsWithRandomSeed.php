<?php

namespace Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

trait InteractsWithRandomSeed
{
    public function randomSeed(string $key, Carbon|int $ttl = 60 * 60): Builder
    {
        return $this->inRandomOrder(
            static::getRandomSeed($key, $ttl)
        );
    }

    protected static function getRandomSeed(string $key, Carbon|int $ttl): mixed
    {
        return Cache::remember(
            sprintf('randomSeed-%s-%s', $key, session()->getId()),
            $ttl,
            fn () => (auth()->id() ?? 0) + time()
        );
    }
}
