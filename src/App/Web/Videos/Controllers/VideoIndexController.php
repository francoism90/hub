<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Concerns\WithFilters;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class VideoIndexController extends Component
{
    use WithFilters;
    use WithPagination;

    #[Url(history: true)]
    public ?string $search = null;

    #[Url(history: true)]
    public ?string $tag = null;

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
