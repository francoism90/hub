<?php

namespace App\Admin\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait InteractsWithScout
{
    protected function applySearchToTableQuery(Builder $query): Builder
    {
        $this->applyColumnSearchesToTableQuery($query);

        if (filled($search = $this->getTableSearch())) {
            $models = app($this->getModel())->search($search);

            $query
                ->whereIn('id', $models->keys())
                ->orderByRaw("FIELD ('id', {$models->keys()->implode(',')})");
        }

        return $query;
    }
}
