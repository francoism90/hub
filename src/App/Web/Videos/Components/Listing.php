<?php

namespace App\Web\Videos\Components;

use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithVideos;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Listing extends Component
{
    use WithPagination;
    use WithTags;
    use WithVideos;

    #[Url(history: true)]
    public ?string $search = '';

    #[Url(history: true)]
    public ?string $sort = '';

    #[Url(history: true)]
    public ?string $tag = '';

    public ?string $type = '';

    abstract public function render(): View;

    abstract protected function builder(): Paginator;

    #[Computed(persist: true, seconds: 60 * 5)]
    public function tags(): TagCollection
    {
        return Tag::query()
            ->type($this->tagType)
            ->orderBy('name')
            ->get()
            ->sortByDesc(fn (Tag $item) => $item->getRouteKey() === $this->tag);
    }

    #[Computed]
    public function tagType(): ?string
    {
        $types = $this->tagTypes();

        if (blank($this->type) && filled($this->tag) && $tag = $this->findTagModel($this->tag)) {
            return $tag->type?->value ?? $types->first();
        }

        return $types->contains($this->type)
            ? $this->type
            : $types->first();
    }

    #[Computed]
    public function tagName(): mixed
    {
        return $this->findTagModel($this->tag)?->name;
    }

    public function toggleTags(): void
    {
        $types = $this->tagTypes();

        $default = $types->first();

        $this->type = $types->after($this->type ?: $default, $default);
    }

    public function setTag(Tag $tag): void
    {
        if ($tag->getRouteKey() === $this->tag) {
            $this->resetQuery('tag');

            return;
        }

        $this->tag = $tag->getRouteKey();

        $this->resetPage();
    }

    public function resetQuery(...$properties): void
    {
        collect($properties)
            ->filter(fn (string $property) => in_array($property, ['search', 'sort', 'tag']))
            ->map(fn (string $property) => $this->reset($property));

        $this->resetPage();
    }

    public function hasSort(string $sort = null): bool
    {
        return filled($this->sort) && $sort === $this->sort;
    }
}
