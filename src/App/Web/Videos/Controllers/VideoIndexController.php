<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Components\Listing;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class VideoIndexController extends Listing
{
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
            ->when(filled($this->tag), fn (Builder $query) => $query->tags((array) $this->tag))
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->take(24 * 6)
            ->paginate(24);
    }
}
