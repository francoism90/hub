<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Components\Listing;
use App\Web\Videos\Concerns\WithTags;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class VideoIndexController extends Listing
{
    use WithTags;

    public function render(): View
    {
        return view('videos::index', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return Video::query()
            ->recommended()
            ->when($this->hasTags(), fn (Builder $query) => $query->tagged($this->tags))
            ->take(32 * 10)
            ->simplePaginate(32);
    }
}
