<?php

namespace App\Admin\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait InteractsWithScout
{
    protected function applySearchToTableQuery(Builder $query): Builder
    {
        $this->applyColumnSearchesToTableQuery($query);

        $search = $this->getTableSearch();

        if (blank($search)) {
            return $query;
        }

        $keys = $this->getModel()::search($search)->keys();

        return $query
            ->whereIn('id', $keys)
            ->when(blank($this->getTableSortColumn()), fn (Builder $query) => $query
                ->orderByRaw('FIND_IN_SET (id, ?)', [$keys->implode(',')])
            );
    }
}
