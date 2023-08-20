<?php

namespace Domain\Shared\Support\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Laravel\Scout\Builder as ScoutBuilder;
use Spatie\QueryBuilder\Filters\Filter;

class QueryFilter implements Filter
{
    public function __invoke(Builder $query, mixed $value, string $property): void
    {
        $column = implode('.', [
            $query->getModel()->getTable(),
            $query->getModel()->getKeyName(),
        ]);

        $keys = $this->reverseQuery($query, $value);

        $query->when($keys->isNotEmpty(),
            fn (Builder $query) => $query
                ->reorder()
                ->whereIn($column, $keys->all())
                ->orderByRaw("FIELD ($column, {$keys->implode(',')})"),
            fn (Builder $query) => $query
                ->where($column, 0)
        );
    }

    protected function reverseQuery(Builder $query, mixed $value = null): LazyCollection
    {
        $value = $this->serializeQuery($value);

        $ids = $this->getModelIds($query);

        $items = LazyCollection::make(function () use ($query, $ids, $value) {
            // e.g. foo bar 1, foo bar, foo
            for ($i = $value->count(); $i >= 1; $i--) {
                $phrase = $value->take($i)->implode(' ');

                yield $query->getModel()::search($phrase)
                    ->when($ids->isNotEmpty(), fn (ScoutBuilder $query) => $query->whereIn('id', $ids->all()))
                    ->take(1000)
                    ->keys();
            }
        });

        return $items
            ->flatten()
            ->unique();
    }

    protected function serializeQuery(mixed $value = null): mixed
    {
        $value = is_array($value) ? implode(', ', $value) : $value;

        return str($value)
            ->headline()
            ->matchAll('/[\p{L}\p{N}]+/u')
            ->filter()
            ->unique()
            ->take(8);
    }

    protected function getModelIds(Builder $query): Collection
    {
        return $query
            ->getQuery()
            ->get('id')
            ->pluck('id')
            ->unique();
    }
}
