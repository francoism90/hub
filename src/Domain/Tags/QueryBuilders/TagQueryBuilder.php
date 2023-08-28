<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Shared\Concerns\InteractsWithScout;
use Domain\Tags\Enums\TagType;
use Illuminate\Database\Eloquent\Builder;

class TagQueryBuilder extends Builder
{
    use InteractsWithScout;

    public function type(TagType|string $type): self
    {
        if (is_string($type)) {
            $type = TagType::tryFrom($type);
        }

        return $this
            ->when(filled($type), fn (Builder $query) => $query->where('type', $type->value));
    }
}
