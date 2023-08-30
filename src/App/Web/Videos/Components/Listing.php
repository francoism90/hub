<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideos;
use Domain\Tags\Models\Tag;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Listing extends Component
{
    use WithPagination;
    use WithVideos;

    #[Url(history: true)]
    public ?string $search = '';

    #[Url(history: true)]
    public ?string $tag = '';

    abstract public function render(): View;

    abstract protected function builder(): Paginator;

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
}
