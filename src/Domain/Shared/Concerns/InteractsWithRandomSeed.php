<?php

namespace Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

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
        $id = auth()->id() ?: session()->getId();

        return cache()->remember(
            sprintf('randomSeed-%s-%s', $id, $key),
            $ttl,
            fn () => time()
        );
    }
}
