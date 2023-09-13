<?php

namespace Domain\Videos\Concerns;

use Domain\Videos\Models\Video;
use Spatie\ResponseCache\Facades\ResponseCache;

trait InteractsWithCache
{
    public static function bootInteractsWithCache(): void
    {
        static::updated(fn (Video $model) => static::forgetResponseCache($model));

        static::deleted(fn (Video $model) => static::forgetResponseCache($model));
    }

    public static function forgetResponseCache(Video $model): void
    {
        ResponseCache::clear(['video', 'vod']);
    }
}
