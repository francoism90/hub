<?php

namespace App\Web\Videos\Concerns;

use Domain\Tags\Models\Tag;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

trait WithTags
{
    #[Url(history: true, as: 't')]
    public array $tags = [];

    #[Url(history: true, as: 'c')]
    public string $type = '';

    #[Computed]
    public function tagOptions(): Collection
    {
        return Tag::query()
            ->type($this->tagType)
            ->ordered()
            ->get()
            ->sortByDesc(fn (Tag $item) => $this->hasTag($item));
    }

    #[Computed]
    public function tagType(): string
    {
        $types = $this->tagTypes();

        if (blank($this->type) && filled($this->tags) && $tag = $this->findTagModel($this->tags[0] ?? '')) {
            return $tag->type?->value ?? $types->first();
        }

        return $types->contains($this->type)
            ? $this->type
            : $types->first();
    }

    public function toggleTags(): void
    {
        $types = $this->tagTypes();

        $default = $types->first();

        $this->type = $types->after($this->type ?: $default, $default);
    }

    public function hasTag(Tag $tag): bool
    {
        return in_array($tag->getRouteKey(), $this->tags);
    }

    public function hasTags(): bool
    {
        return filled($this->tags);
    }

    public function resetTags(): void
    {
        $this->reset('tags');
    }
}
