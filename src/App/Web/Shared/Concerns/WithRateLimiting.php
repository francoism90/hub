<?php

namespace App\Web\Shared\Concerns;

use Illuminate\Support\Facades\RateLimiter;

trait WithRateLimiting
{
    protected function rateLimit(int $maxAttempts, float $decaySeconds = 60, string $method = null): void
    {
        $method ??= debug_backtrace()[1]['function'];

        $key = $this->getRateLimitKey($method);

        logger($key);

        // throw_if(RateLimiter::tooManyAttempts($key, $maxAttempts));

        $this->hitRateLimiter($method, $decaySeconds);
    }

    protected function clearRateLimiter(string $method = null): void
    {
        $method ??= debug_backtrace()[1]['function'];

        $key = $this->getRateLimitKey($method);

        RateLimiter::clear($key);
    }

    protected function getRateLimitKey(string $method): string
    {
        return sha1(static::class.'|'.$method.'|'.request()->ip());
    }

    protected function hitRateLimiter(string $method, float $decaySeconds = 60): void
    {
        $key = $this->getRateLimitKey($method);

        RateLimiter::hit($key, $decaySeconds);
    }
}
