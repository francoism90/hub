<?php

namespace Domain\Videos\Actions;

use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;
use Illuminate\Support\LazyCollection;

class GetSimilarVideos
{
    public function execute(Video $model, int $limit = 24): LazyCollection
    {
        return LazyCollection::make([
            ...static::phrases($model),
            ...static::tagged($model),
        ])->take($limit);
    }

    public static function phrases(Video $model): LazyCollection
    {
        $query = str($model->name)
            ->title()
            ->matchAll('/[\p{L}\p{N}]+/u')
            ->reject(fn (string $word) => in_array(mb_strtolower($word), ['and', 'a', 'or']))
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

    public static function tagged(Video $model): LazyCollection
    {
        $relatables = $model->tags
            ->loadMissing('relatables')
            ->flatMap(fn (Tag $tag) => $tag->related)
            ->unique()
            ->all();

        return Video::query()
            ->published()
            ->withAnyTagsOfAnyType([
                ...$model->tags,
                ...$relatables,
            ])
            ->whereKeyNot($model)
            ->randomSeed(key: 'similar-tagged', ttl: now()->addMinutes(20))
            ->take(12)
            ->cursor();
    }
}
