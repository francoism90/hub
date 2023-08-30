<?php

namespace App\Web\Videos\Components;

use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithVideos;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
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

    abstract public function render(): View;

    abstract protected function builder(): Paginator;

    public function resetQuery(...$properties): void
    {
        collect($properties)
            ->filter(fn (string $property) => in_array($property, ['search', 'tag']))
            ->map(fn (string $property) => $this->reset($property));

        $this->resetPage();
    }
}
