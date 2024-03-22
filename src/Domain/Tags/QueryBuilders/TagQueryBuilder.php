<?php

namespace Domain\Tags\QueryBuilders;

use Domain\Shared\Concerns\InteractsWithScout;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Support\Arrayable;
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

    public function related(Arrayable|array|Tag|null $values = null): self
    {
        $keys = collect();

        $tags = TagCollection::make($values)->convert();

        $tags->each(fn (Tag $item) => $keys->push(...$item->relatables->pluck('relate_id')->toArray()));

        return $this->when($keys, fn (Builder $query) => $query->whereIn('id', $keys));
    }
}
