<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Tags\Enums\TagType;
use Illuminate\Database\Eloquent\Builder;

class TagQueryBuilder extends Builder
{
    public function recommended(int $ttl = 600): self
    {
        return $this
            ->randomSeed(key: 'tags', ttl: $ttl);
    }

    public function type(TagType|string $value): self
    {
        $type = ! $value instanceof TagType
            ? TagType::tryFrom($value)
            : $value;

        return $this->when(filled($type), fn (Builder $query) => $query
            ->where('type', $type)
        );
    }
}
