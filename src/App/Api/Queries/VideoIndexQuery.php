<?php

namespace App\Api\Queries;

use Domain\Shared\Support\QueryBuilder\Filters\QueryFilter;
use Domain\Shared\Support\QueryBuilder\Sorts\AttributeSorter;
use Domain\Videos\Models\Video;
use Domain\Videos\Support\QueryBuilder\Filters\FeatureFilter;
use Domain\Videos\Support\QueryBuilder\Filters\ListFilter;
use Domain\Videos\Support\QueryBuilder\Filters\TagFilter;
use Domain\Videos\Support\QueryBuilder\Sorts\DurationSorter;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class VideoIndexQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Video::query()
            ->with([
                'favoriters',
                'followers',
                'tags',
                'views',
            ]);

        parent::__construct($query, $request);

        $this
            ->allowedFilters([
                AllowedFilter::custom('list', new ListFilter())->default('recommended'),
                AllowedFilter::custom('feature', new FeatureFilter()),
                AllowedFilter::custom('tag', new TagFilter()),
                AllowedFilter::custom('query', new QueryFilter()),
            ])
            ->allowedSorts([
                AllowedSort::custom('name', new AttributeSorter(), 'name'),
                AllowedSort::custom('created_at', new AttributeSorter(), 'created_at'),
                AllowedSort::custom('duration', new DurationSorter()),
            ]);
    }
}
