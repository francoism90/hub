<?php

namespace Domain\Tags\Actions;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\Support\LazyCollection;

class SetTagsOrder
{
    public function execute(): void
    {
        $items = collect();

        $items = $items->merge([
            ...$this->getTags(TagType::Studio),
            ...$this->getTags(TagType::Person),
            ...$this->getTags(TagType::Language),
            ...$this->getTags(TagType::Genre),
        ]);

        Tag::setNewOrder(
            $items->pluck('id')->all()
        );

        // Remove caches
        cache()->forget('tags');
    }

    protected function getTags(TagType $value): LazyCollection
    {
        return Tag::query()
            ->type($value)
            ->orderBy('name')
            ->cursor()
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE);
    }
}
