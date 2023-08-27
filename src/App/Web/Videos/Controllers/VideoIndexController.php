<?php

namespace App\Web\Videos\Controllers;

use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithVideos;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class VideoIndexController extends Component
{
    use WithVideos;
    use WithTags;
    use WithPagination;

    #[Url(history: true)]
    public ?string $search = '';

    #[Url(history: true)]
    public ?string $tag = '';

    public ?string $type = 'genre';

    public function mount(): void
    {
        if (blank($this->tag)) {
            return;
        }

        $types = $this->tagTypes();

        $tag = $this->findTagModel($this->tag);

        $this->type = $tag instanceof Tag && filled($tag->type)
            ? $types->first(fn (string $type) => $tag->type->value === $type)
            : $types->first();
    }

    public function render(): View
    {
        return view('videos::index', [
            'items' => $this->builder(),
        ]);
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

    protected function builder(): Paginator
    {
        return Video::query()
            ->with('tags')
            ->inRandomSeedOrder()
            ->when(filled($this->tag), fn (Builder $query) => $query->tags((array) $this->tag))
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->take(12 * 6)
            ->paginate(12);
    }
}
