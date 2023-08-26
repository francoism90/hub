<?php

namespace App\Web\Videos\Concerns;

use Domain\Tags\Models\Tag;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Enums\TagType;
use Livewire\Attributes\Computed;

trait WithFilters
{
    public ?string $type = null;

    public function bootWithFilters(): void
    {
        $this->authorize('viewAny', Tag::class);
    }

    public function mountWithFilters(): void
    {
        if (blank($this->tag)) {
            return;
        }

        $types = collect(TagType::toValues());

        $tag = Tag::findByPrefixedId($this->tag);

        $this->type = $tag instanceof Tag && filled($tag->type)
            ? $types->first(fn (string $type) => $tag->type->value === $type)
            : $types->first();
    }

    #[Computed]
    public function tags(): TagCollection
    {
        return Tag::query()
            ->type($this->type)
            ->orderBy('name')
            ->get()
            ->sortByDesc(fn (Tag $item) => $item->getRouteKey() === $this->tag);
    }

    #[Computed]
    public function tagLabel(): string
    {
        return TagType::tryFrom($this->type)->label;
    }

    public function toggle(): void
    {
        $types = collect(TagType::toValues());

        $this->type = $types->after($this->type, $types->first());
    }
}
