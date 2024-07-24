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

        foreach (TagType::cases() as $type) {
            $items = $items->merge($this->getTags($type));
        }

        Tag::setNewOrder($items->pluck('id')->all());

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
