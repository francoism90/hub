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
            ...$this->getTags(TagType::studio()),
            ...$this->getTags(TagType::person()),
            ...$this->getTags(TagType::language()),
            ...$this->getTags(TagType::genre()),
        ]);

        Tag::setNewOrder(
            $items->pluck('id')->all()
        );
    }

    protected function getTags(TagType $value): LazyCollection
    {
        return Tag::query()
            ->whereType($value)
            ->orderBy('name')
            ->cursor();
    }
}
