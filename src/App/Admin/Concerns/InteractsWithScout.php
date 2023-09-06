<?php

namespace App\Admin\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait InteractsWithScout
{
    protected function applySearchToTableQuery(Builder $query): Builder
    {
        $this->applyColumnSearchesToTableQuery($query);

        $value = $this->getTableSearch();

        if (blank($value)) {
            return $query;
        }

        return $query
            ->search($value)
            ->when(filled($this->getTableSortColumn()), fn (Builder $query) => $query->reorder());
    }
}
