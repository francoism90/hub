<?php

namespace App\Web\Videos\Controllers;

use Domain\Tags\Models\Tag;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class VideoIndexController extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public ?string $search = null;

    #[Url(history: true)]
    public ?string $tag = null;

    #[Url(history: true)]
    public ?string $type = null;

    public function boot(): void
    {
        $this->authorize('viewAny', Video::class);
    }

    public function render(): View
    {
        return view('videos::index', [
            'items' => $this->builder(),
        ]);
    }

    public function setTag(Tag $model): void
    {
        $this->tag = $model->getRouteKey();

        $this->resetPage();
    }

    protected function builder(): Paginator
    {
        return Video::query()
            ->with('tags')
            ->when(filled($this->tag), fn (Builder $query) => $query->tags((array) $this->tag))
            ->when(filled($this->search), fn (Builder $query) => $query->search(
                value: $this->search,
                limit: 12 * 6
            ))
            ->inRandomSeedOrder()
            ->paginate(12);
    }
}
