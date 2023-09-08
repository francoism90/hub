<?php

namespace Domain\Videos\Actions;

use Domain\Videos\Models\Video;
use Illuminate\Support\LazyCollection;

class GetSimilarVideos
{
    public function execute(Video $model): LazyCollection
    {
        $items = LazyCollection::make();

        return $items->merge([
            ...$this->phrases($model),
            ...$this->tagged($model),
            ...$this->random($model),
        ]);
    }

    protected function phrases(Video $model): LazyCollection
    {
        $query = str($model->name)
            ->headline()
            ->matchAll('/[\p{L}\p{N}]+/u')
            ->reject(fn (string $word) => in_array($word, ['and', 'a', 'or']))
            ->take(8)
            ->merge([
                $model->season,
                $model->episode,
                $model->released_at,
            ])
            ->filter()
            ->unique();

        $items = LazyCollection::make(function () use ($query) {
            // e.g. foo bar 1, foo bar, foo
            for ($i = $query->count(); $i >= 1; $i--) {
                $phrase = (string) $query->take($i)->implode(' ');

                yield Video::search($phrase)
                    ->take(6)
                    ->cursor();
            }
        });

        return $items
            ->flatten()
            ->reject(fn (Video $item) => $item->is($model))
            ->unique();
    }

    protected function tagged(Video $model): LazyCollection
    {
        return Video::query()
            ->whereHas('tags')
            ->whereKeyNot($model)
            ->withAnyTagsOfAnyType($model->tags)
            ->randomSeed(key: 'tagged', ttl: 60 * 10)
            ->take(6)
            ->cursor();
    }

    protected function random(Video $model): LazyCollection
    {
        return Video::query()
            ->whereKeyNot($model)
            ->randomSeed(key: 'random', ttl: 60 * 10)
            ->take(6)
            ->cursor();
    }
}
