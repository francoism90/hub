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
    use WithVideos;
    use WithTags;
    use WithPagination;

    #[Url(history: true)]
    public ?string $search = '';

    #[Url(history: true)]
    public ?string $tag = '';

    #[Url(history: true)]
    public ?string $type = '';

    abstract public function render(): View;

    abstract protected function builder(): Paginator;

    public function mount(): void
    {
        $types = $this->tagTypes();

        $this->type = (filled($this->tag) && $tag = $this->findTagModel($this->tag))
            ? $types->first(fn (string $type) => $tag->type?->value === $type)
            : $types->first();
    }

    public function setTag(Tag $model): void
    {
        if ($model->getRouteKey() === $this->tag) {
            $this->resetQuery('tag');

            return;
        }

        $this->tag = $model->getRouteKey();

        $this->resetPage();
    }

    public function toggleType(): void
    {
        $types = $this->tagTypes();

        $this->type = $types->after($this->type, $types->first());
    }

    public function resetQuery(...$properties): void
    {
        collect($properties)
            ->filter(fn (string $property) => in_array($property, ['search', 'tag']))
            ->map(fn (string $property) => $this->reset($property));

        $this->resetPage();
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
    public function tagType(): ?string
    {
        return $this->findTagType($this->type)?->label;
    }

    #[Computed]
    public function tagName(): mixed
    {
        return $this->findTagModel($this->tag)?->name;
    }
}
