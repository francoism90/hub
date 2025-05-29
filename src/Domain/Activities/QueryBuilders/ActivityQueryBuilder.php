<?php

declare(strict_types=1);

namespace Domain\Activities\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ActivityQueryBuilder extends Builder
{
    public function type(string $type): self
    {
        return $this->where('type', $type);
    }

    public function types(array $types): self
    {
        return $this->whereIn('type', $types);
    }
}
