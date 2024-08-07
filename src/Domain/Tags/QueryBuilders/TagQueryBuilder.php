<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Tags\Enums\TagType;
use Illuminate\Database\Eloquent\Builder;

class TagQueryBuilder extends Builder
{
    public function random(int $ttl = 60 * 60): self
    {
        return $this
            ->randomSeed('tags-random', $ttl);
    }

    public function type(TagType|string $value): self
    {
        $type = $value instanceof TagType ? $value : TagType::tryFrom($value);

        return $this->when($type, fn (Builder $query) => $query
            ->where('type', $type)
        );
    }
}
