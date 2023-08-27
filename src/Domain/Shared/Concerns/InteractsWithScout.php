<?php

namespace Domain\Shared\Concerns;

trait InteractsWithScout
{
    public function search(string $value = '*', int $limit = 10): self
    {
        $models = $this->getModel()->search($value)->take($limit);

        return $this
            ->reorder()
            ->whereIn('id', $models->keys())
            ->take($limit)
            ->orderByRaw('FIELD (id, ?)', [$models->keys()->implode(',')]);
    }
}
