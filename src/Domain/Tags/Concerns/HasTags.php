<?php

namespace Domain\Videos\Concerns;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Spatie\Tags\HasTags as BaseHasTags;

trait HasTags
{
    use BaseHasTags;

    public function getTagsBySeo(): string
    {
        return collect(TagType::cases())
            ->map(fn (TagType $type) => $this->tags()->type($type)->get()->seo())
            ->filter()
            ->implode(', ');
    }

    public function getRelatedTagsBySeo(): string
    {
        $relatableTags = $this->tags->flatMap(fn (Tag $tag) => $tag
            ->relatables()
            ->get()
            ->relates()
        );

        return TagCollection::make($relatableTags->all())->seo();
    }
}
