<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Tags\Enums\TagType;
use Illuminate\Database\Eloquent\Builder;

class TagQueryBuilder extends Builder
{
    public function type(TagType|string $type): self
    {
        if (is_string($type)) {
            $type = TagType::tryFrom($type);
        }

        return $this->where('type', $type->value);
    }
}
