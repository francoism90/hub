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
            ->map(fn (string $value) => Tag::findByPrefixedId($value))
            ->unique()
            ->filter();

        $query
            ->reorder()
            ->withAllTagsOfAnyType($models)
            ->randomSeed(key: 'tag-type', ttl: 60 * 60);
    }
}
