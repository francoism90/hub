<?php

namespace Domain\Users\Concerns;

use Domain\Users\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
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
        ResponseCache::clear(['user-'.$model->getKey()]);
    }

    public function storeKey(string $key): string
    {
        return sprintf('user:%s:%s', $this->getKey(), $key);
    }

    public function storeSet(string $key, mixed $value = null, Carbon|int|null $ttl = null): bool
    {
        return Cache::put($this->storeKey($key), $value, $ttl);
    }

    public function storeValue(string $key, mixed $default = null): mixed
    {
        return Cache::get($this->storeKey($key), $default);
    }

    public function storeForget(string $key): mixed
    {
        return Cache::forget($this->storeKey($key));
    }
}
