<?php

namespace Domain\Tags\Concerns;

use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

trait InteractsWithTags
{
    protected static function convertToTags(Arrayable|array|Tag|null $values = null): Collection
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
