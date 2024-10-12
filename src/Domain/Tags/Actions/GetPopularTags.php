<?php

namespace Domain\Tags\Actions;

use Domain\Tags\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GetPopularTags
{
    public function execute(): mixed
    {
        $keys = $this->getModelKeys();

        return Cache::remember('tags-popular', 60 * 10, fn () => Tag::query()
            ->whereIn('id', $keys)
            ->get()
            ->sortBy(fn (Tag $tag) => array_search($tag->getKey(), $keys->toArray()))
        );
    }

    protected function getModelKeys(int $limit = 40): Collection
    {
        return DB::table('taggables')
            ->selectRaw('id, count(tag_id) as tagged_count')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tags.id')
            ->orderBy('tagged_count', 'desc')
            ->take($limit)
            ->pluck('id');
    }
}
