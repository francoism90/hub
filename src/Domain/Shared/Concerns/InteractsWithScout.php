<?php

namespace Domain\Shared\Concerns;

trait InteractsWithScout
{
    public function search(string $value = '*'): self
    {
        $column = $this->getTableColumn();

        $models = $this->getModel()->search($value)->take(500);

        return $this
            ->reorder()
            ->whereIn($column, $models->keys())
            ->orderByRaw("FIELD ({$column}, ?)", [$models->keys()->implode(',')]);
    }

    protected function getTableColumn(): string
    {
        return implode('.', [
            $this->getModel()->getTable(),
            $this->getModel()->getKeyName(),
        ]);
    }
}
