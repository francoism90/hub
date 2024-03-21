<?php

namespace Domain\Shared\Concerns;

use Illuminate\Support\Collection;
use Laravel\Scout\Builder;
use Meilisearch\Endpoints\Indexes;

trait InteractsWithScout
{
    public function search(string $value = '*', array $options = [], bool $scopes = false): self
    {
        $column = $this->getTableColumn();

        $keys = $this->getScoutKeys($value, $options, $scopes);

        return $this
            ->reorder()
            ->whereIn($column, $keys)
            ->orderByRaw("FIND_IN_SET ({$column}, ?)", [$keys->implode(',')]);
    }

    protected function getScoutKeys(string $value = '*', array $parameters = [], bool $scopes = false): Collection
    {
        return $this
            ->getModel()
            ->search($value, function (Indexes $engine, string $query, array $options) use ($parameters) {
                $options = array_merge_recursive($options, $parameters);

                return $engine->search($query, $options);
            })
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
