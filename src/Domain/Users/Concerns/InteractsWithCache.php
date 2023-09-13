<?php

namespace Domain\Users\Concerns;

use Domain\Users\Models\User;
use Spatie\ResponseCache\Facades\ResponseCache;

trait InteractsWithCache
{
    public static function bootInteractsWithCache(): void
    {
        static::updated(fn (User $model) => static::forgetResponseCache($model));

        static::deleted(fn (User $model) => static::forgetResponseCache($model));
    }

    public static function forgetResponseCache(User $model): void
    {
        ResponseCache::clear(['auth', 'user']);
    }
}
