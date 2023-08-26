<?php

namespace App\Web\Videos\Controllers;

use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class VideoIndexController extends Component
{
    use WithPagination;

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
            ->inRandomSeedOrder()
            ->paginate(12);
    }
}
