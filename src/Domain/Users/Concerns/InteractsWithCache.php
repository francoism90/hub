<?php

namespace Domain\Users\Concerns;

use Domain\Users\Models\User;
use Spatie\ResponseCache\Facades\ResponseCache;

trait InteractsWithCache
{
    public static function bootInteractsWithCache(): void
    {
        static::updated(fn (User $model) => $this->forgetResponseCache($model));

        static::deleted(fn (User $model) => $this->forgetResponseCache($model));
    }

    public function forgetResponseCache(User $model): void
    {
        ResponseCache::clear(['user-'.$model->getKey()]);
    }
}
