<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class GetSimilarVideos
{
    public function execute(Video $model): Collection
    {
        return collect()->merge([
            ...static::phrases($model),
            ...static::tagged($model),
            ...static::random($model),
        ]);
    }

    protected static function phrases(Video $model): LazyCollection
    {
        $query = str($model->name)
            ->headline()
            ->matchAll('/[\p{L}\p{N}]+/u')
            ->reject(fn (string $word) => in_array($word, ['and', 'a', 'or']))
            ->take(7)
            ->merge([$model->identifier, $model->released_at])
            ->filter()
            ->unique();

        $items = LazyCollection::make(function () use ($query) {
            // e.g. foo bar 1, foo bar, foo
            for ($i = $query->count(); $i >= 1; $i--) {
                $phrase = (string) $query->take($i)->implode(' ');

                yield Video::search($phrase)
                    ->where('state', Verified::$name)
                    ->take(8)
                    ->cursor();
            }
        });

        return $items
            ->flatten()
            ->reject(fn (Video $item) => $item->is($model))
            ->take(24)
            ->unique();
    }

    protected static function tagged(Video $model): LazyCollection
    {
        return Video::query()
            ->published()
            ->withWhereHas('tags')
            ->whereKeyNot($model)
            ->tagged($model->tags)
            ->take(8)
            ->cursor();
    }

    protected static function random(Video $model): LazyCollection
    {
        return Video::query()
            ->published()
            ->whereKeyNot($model)
            ->randomSeed(key: 'random', ttl: now()->addMinutes(20))
            ->take(8)
            ->cursor();
    }
}
