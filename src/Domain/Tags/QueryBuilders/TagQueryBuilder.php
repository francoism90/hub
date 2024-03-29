<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Shared\Concerns\InteractsWithScout;
use Domain\Tags\Enums\TagType;
use Illuminate\Database\Eloquent\Builder;

class TagQueryBuilder extends Builder
{
    use InteractsWithScout;

    public function recommended(): self
    {
        return $this
            ->randomSeed(key: 'tags', ttl: now()->addMinutes(10));
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
