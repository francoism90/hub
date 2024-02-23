<?php

namespace Domain\Tags\Concerns;

use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait InteractsWithTags
{
    public function tagged(Arrayable|array|Tag|null $values = null): self
    {
        $items = static::convertToTags($values);

        return $this->when($items->isNotEmpty(), fn (Builder $query) => $query
            ->withWhereHas('tags', fn ($query) => $query
                ->whereIn('tags.id', $items->pluck('id'))
            )
        );
    }

    protected static function convertToTags(Arrayable|array|Tag|null $values = null): Collection
    {
        return collect($values)
            ->map(fn (mixed $item): ?Tag => ! $item instanceof Tag
                ? Tag::findByPrefixedId($item)
                : $item
            )
            ->filter()
            ->unique();
    }
}
