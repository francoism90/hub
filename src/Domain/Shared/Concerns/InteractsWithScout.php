<?php

namespace Domain\Shared\Concerns;

use Illuminate\Support\Collection;
use Laravel\Scout\Builder;

trait InteractsWithScout
{
    public function search(string $value = '*'): self
    {
        $column = $this->getTableColumn();

        $keys = $this->getScoutKeys($value);

        return $this
            ->reorder()
            ->whereIn($column, $keys)
            ->orderByRaw("FIND_IN_SET ({$column}, ?)", [$keys->implode(',')]);
    }

    protected function getScoutKeys(string $value): Collection
    {
        $ids = $this->getWheres()->get('id');

        return $this
            ->getModel()
            ->search($value)
            ->when(filled($ids), fn (Builder $query) => $query->whereIn('id', $ids))
            ->keys();
    }

    protected function getTableColumn(): string
    {
        return implode('.', [
            $this->getModel()->getTable(),
            $this->getModel()->getKeyName(),
        ]);
    }

    protected function getWheres(): Collection
    {
        return collect($this->getQuery()->wheres)
            ->filter(fn (array $where) => array_key_exists('column', $where))
            ->mapWithKeys(fn (array $where) => [$where['column'] => $where['values'] ?? null]);
    }
}
