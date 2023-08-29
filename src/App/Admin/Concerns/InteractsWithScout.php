<?php

namespace App\Admin\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait InteractsWithScout
{
    protected function applySearchToTableQuery(Builder $query): Builder
    {
        $search = $this->getTableSearch();

        $this->applyColumnSearchesToTableQuery($query);

        return $query
            ->when(filled($search), fn (Builder $query) => $query->search($search));
    }
}
