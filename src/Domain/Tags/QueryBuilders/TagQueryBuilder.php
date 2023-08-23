<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Tags\Enums\TagType;
use Illuminate\Database\Eloquent\Builder;

class TagQueryBuilder extends Builder
{
    public function type(TagType $type): self
    {
        return $this->where('type', $type->value);
    }
}
