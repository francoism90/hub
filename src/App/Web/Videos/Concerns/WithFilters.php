<?php

namespace App\Web\Videos\Concerns;

use Domain\Tags\Models\Tag;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

trait WithFilters
{
    #[Url(history: true)]
    public string $search = '';

    #[Url(history: true)]
    public string $sort = '';

    #[Url(history: true)]
    public array $tags = [];

    #[Url(history: true)]
    public string $type = '';

    #[Computed]
    public function tagOptions(): Collection
    {
        return Tag::query()
            ->type($this->tagType)
            ->ordered()
            ->get()
            ->sortByDesc(fn (Tag $item) => $this->hasTags($item));
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

    public function hasTags(Tag $tag): bool
    {
        return in_array($tag->getRouteKey(), $this->tags);
    }

    public function resetQuery(...$properties): void
    {
        collect($properties)
            ->filter(fn (string $property) => in_array($property, ['search', 'sort', 'tag', 'type']))
            ->map(fn (string $property) => $this->reset($property));

        $this->resetPage();
    }
}
