<?php

namespace Domain\Shared\Concerns;

use Illuminate\Support\Collection;

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
        $ids = $this->getIds();

        return $this
            ->getModel()
            ->search($value)
            ->when($ids->isNotEmpty(), fn ($query) => $query->whereIn('id', $ids->toArray()))
            ->keys();
    }

    protected function getTableColumn(): string
    {
        return implode('.', [
            $this->getModel()->getTable(),
            $this->getModel()->getKeyName(),
        ]);
    }

    protected function getIds(): Collection
    {
        if (blank($this->getQuery()->wheres)) {
            return collect();
        }

        return $this
            ->get('id')
            ->pluck('id')
            ->unique();
    }
}
