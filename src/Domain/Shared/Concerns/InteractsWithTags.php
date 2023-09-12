<?php

namespace Domain\Shared\Concerns;

use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

trait InteractsWithTags
{
    protected static function convertToTags(Arrayable|array|Tag $values = null): Collection
    {
        return collect($values)
            ->map(fn (Tag|string $item) => ! $item instanceof Tag
                ? Tag::findByPrefixedId($item)
                : $item
            )
            ->filter()
            ->unique();
    }
}
