<?php

namespace Domain\Videos\Support\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class TagFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property): void
    {
        $query->when(filled($value), fn (Builder $query) => $query
            ->tags($value)
        );
    }
}
