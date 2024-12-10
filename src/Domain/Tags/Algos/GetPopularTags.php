<?php

declare(strict_types=1);

namespace Domain\Tags\Algos;

use Foxws\Algos\Algos\Algo;
use Foxws\Algos\Algos\Result;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class GetPopularTags extends Algo
{
    public function handle(): Result
    {
        $items = Cache::remember(
            'tags-popular', 60 * 60 * 4, fn () => $this->getTaggables()->collect()
        );

        return $this->success()
            ->with('items', $items);
    }

    protected function getTaggables(): LazyCollection
    {
        return DB::table('taggables')
            ->selectRaw('id, count(tag_id) as tag_count')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tags.id')
            ->orderByDesc('tag_count')
            ->take(24)
            ->lazy();
    }
}
