<?php

namespace Domain\Videos\Support\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class FeatureFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property): void
    {
        $value = collect($value);

        $query
            ->when($value->contains('cc'), fn (Builder $query) => $query->captions())
            ->when($value->contains('hq'), fn (Builder $query) => $query->quality());
    }
}
