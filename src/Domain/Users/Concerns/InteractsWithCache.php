<?php

declare(strict_types=1);

namespace Domain\Users\Concerns;

use Domain\Users\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Spatie\ResponseCache\Facades\ResponseCache;

trait InteractsWithCache
{
    public static function bootInteractsWithCache(): void
    {
        static::updated(fn (User $model) => static::clearResponseCache($model));

        static::deleted(fn (User $model) => static::clearResponseCache($model));
    }

    public static function clearResponseCache(User $model): void
    {
        ResponseCache::clear(['user-'.$model->getKey()]);
    }

    public function storeKey(string $key): string
    {
        $hash = hash('crc32c', serialize([$this->getKey(), $key]));

        return sprintf('user-%s', $hash);
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
