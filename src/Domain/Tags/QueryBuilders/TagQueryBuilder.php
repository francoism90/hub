<?php

namespace Domain\Tags\QueryBuilders;

use ArrayAccess;
use Domain\Shared\Concerns\InteractsWithScout;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Builder;

class TagQueryBuilder extends Builder
{
    use InteractsWithScout;

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
