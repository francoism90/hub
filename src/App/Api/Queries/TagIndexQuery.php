<?php

namespace App\Api\Queries;

use Domain\Shared\Support\QueryBuilder\Filters\QueryFilter;
use Domain\Shared\Support\QueryBuilder\Sorts\AttributeSorter;
use Domain\Tags\Models\Tag;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class TagIndexQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Tag::query();

        parent::__construct($query, $request);

        $this
            ->allowedFilters([
                AllowedFilter::custom('query', new QueryFilter()),
            ])
            ->allowedSorts([
                AllowedSort::custom('name', new AttributeSorter(), 'tags.name'),
            ]);
    }
}
