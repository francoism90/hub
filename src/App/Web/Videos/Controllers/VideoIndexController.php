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
            ->recommended()
            ->when(filled($this->tags), fn (Builder $query) => $query->tagged($this->tags))
            ->take(24 * 8)
            ->simplePaginate(24);
    }
}
