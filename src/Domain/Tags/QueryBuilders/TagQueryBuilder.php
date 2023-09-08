<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Shared\Concerns\InteractsWithRandomSeed;
use Domain\Shared\Concerns\InteractsWithScout;
use Domain\Tags\Enums\TagType;
use Illuminate\Database\Eloquent\Builder;

class TagQueryBuilder extends Builder
{
    use InteractsWithRandomSeed;
    use InteractsWithScout;

    public function type(TagType|string $value): self
    {
        $type = ! $value instanceof TagType
            ? TagType::tryFrom($value)
            : $value;

        return $this->when(filled($type), fn (Builder $query) => $query
            ->where('type', $type->value)
        );
    }
}
