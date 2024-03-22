<?php

namespace Domain\Relates\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class RelatedQueryBuilder extends Builder
{
    public function scores(): self
    {
        return $this
            ->withWhereHas('relate')
            ->orderByDesc('score')
            ->orderByDesc('boost');
    }
}
