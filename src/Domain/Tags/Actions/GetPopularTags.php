<?php

declare(strict_types=1);

namespace Domain\Tags\Actions;

use Domain\Tags\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GetPopularTags
{
    public function execute(): mixed
    {
        return Cache::remember(
            'tags-popular', 60 * 10, fn () => $this->getModelCollection()
        );
    }

    protected function getModelCollection(): Collection
    {
        $keys = $this->getModelKeys();

        return Tag::query()
            ->whereIn('id', $keys)
            ->get()
            ->sortBy(fn (Tag $tag) => array_search($tag->getKey(), $keys->toArray()));
    }

    protected function getModelKeys(): Collection
    {
        return DB::table('taggables')
            ->selectRaw('id, count(tag_id) as tagged_count')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tags.id')
            ->orderBy('tagged_count', 'desc')
            ->take(48)
            ->pluck('id');
    }
}
