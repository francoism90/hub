<?php

namespace Domain\Tags\Concerns;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Tags\HasTags as BaseHasTags;

trait HasTags
{
    use BaseHasTags;

    public function getTagsByType(): string
    {
        return TagCollection::make(TagType::cases())
            ->map(fn (TagType $type) => $this->tags()->type($type)->get()->translated())
            ->filter()
            ->implode(', ');
    }

    public function getRelatedTags(): string
    {
        $items = $this->tags->flatMap(fn (Tag $tag) => $tag->relates);

        return TagCollection::make($items->all())->translated();
    }

    protected function tagsTranslated(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getTagsByType()
        )->shouldCache();
    }

    protected function tagsRelated(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getRelatedTags()
        )->shouldCache();
    }
}
