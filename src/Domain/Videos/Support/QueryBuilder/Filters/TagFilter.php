<?php

namespace Domain\Videos\Support\QueryBuilder\Filters;

use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class TagFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property): void
    {
        $models = collect($value)
            ->map(fn (string $value) => Tag::findByPrefixedIdOrFail($value));

        $query
            ->withAllTagsOfAnyType($models)
            ->reorder()
            ->inRandomSeedOrder();
    }
}
