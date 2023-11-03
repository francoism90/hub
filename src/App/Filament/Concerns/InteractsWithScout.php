<?php

namespace App\Filament\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait InteractsWithScout
{
    protected function applySearchToTableQuery(Builder $query): Builder
    {
        $this->applyColumnSearchesToTableQuery($query);

        $value = $this->getTableSearch();

        if (blank($value) || ! is_string($value)) {
            return $query;
        }

        return $query
            ->search($value)
            ->when(filled($this->getTableSortColumn()), fn (Builder $query) => $query->reorder());
    }
}
