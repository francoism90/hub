<?php

namespace Domain\Relates\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class RelatedQueryBuilder extends Builder
{
    public function scores(): self
    {
        return $this
            ->orderByDesc('score')
            ->orderByDesc('boost')
            ->latest();
    }
}
