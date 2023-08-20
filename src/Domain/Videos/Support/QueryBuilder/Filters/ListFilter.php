<?php

namespace Domain\Videos\Support\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ListFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property): void
    {
        $value = collect($value);

        $query
            ->when($value->contains('recommended'), fn (Builder $query) => $query->recommended())
            ->when($value->contains('favorites'), fn (Builder $query) => $query->favorites())
            ->when($value->contains('watchlist'), fn (Builder $query) => $query->following())
            ->when($value->contains('history'), fn (Builder $query) => $query->viewed());
    }
}
