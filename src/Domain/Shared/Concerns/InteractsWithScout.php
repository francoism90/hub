<?php

namespace Domain\Shared\Concerns;

use Illuminate\Support\Collection;
use Laravel\Scout\Builder;

trait InteractsWithScout
{
    public function search(string $value = '*', bool $scopes = false): self
    {
        $column = $this->getTableColumn();

        $keys = $this->getScoutKeys($value, $scopes);

        return $this
            ->reorder()
            ->whereIn($column, $keys)
            ->orderByRaw("FIND_IN_SET ({$column}, ?)", [$keys->implode(',')]);
    }

    protected function getScoutKeys(string $value = '*', bool $scopes = false): Collection
    {
        return $this
            ->getModel()
            ->search($value)
            ->when($scopes, fn (Builder $query) => $query->whereIn('id', $this->getModelKeys()))
            ->take($this->getScoutLimit())
            ->keys();
    }

    protected function getScoutLimit(): int
    {
        return $this->getQuery()->limit ?? 1500;
    }

    protected function getTableColumn(): string
    {
        return implode('.', [
            $this->getModel()->getTable(),
            $this->getModel()->getKeyName(),
        ]);
    }

    protected function getModelKeys(): array
    {
        return $this
            ->get()
            ->take($this->getScoutLimit())
            ->modelKeys();
    }
}
