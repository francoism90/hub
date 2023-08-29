<?php

namespace Domain\Shared\Concerns;

use Laravel\Scout\Builder;

trait InteractsWithScout
{
    public function search(string $value = '*'): self
    {
        $column = $this->getTableColumn();

        $models = $this->getScoutBuilder($value);

        return $this
            ->reorder()
            ->whereIn($column, $models->keys())
            ->orderByRaw("FIELD ({$column}, ?)", [$models->keys()->implode(',')]);
    }

    protected function getScoutBuilder(string $value): Builder
    {
        return $this
            ->getModel()
            ->search($value)
            ->take(config('scout.pagination.maxTotalHits', 500));
    }

    protected function getTableColumn(): string
    {
        return implode('.', [
            $this->getModel()->getTable(),
            $this->getModel()->getKeyName(),
        ]);
    }
}
