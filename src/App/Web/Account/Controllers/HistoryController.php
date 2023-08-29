<?php

namespace App\Web\Account\Controllers;

use App\Web\Videos\Components\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class HistoryController extends Listing
{
    public function mount(): void
    {
        parent::mount();

        SEOMeta::setTitle(__('History'));
    }

    public function render(): View
    {
        return view('account::history', [
            'items' => $this->builder(),
        ]);
    }

    protected function getPlaylist()
    {
        return Playlist::query()
            ->history();
    }

    protected function builder(): mixed
    {
        $query = Playlist::query()
            ->history()
            ->first();

        if (! $query) {
            return Video::query()
                ->where('id', 0)
                ->paginate(12);
        }

        return $query
            ->videos()
            ->with('tags')
            ->orderByDesc('videoables.updated_at')
            ->take(12 * 6)
            ->paginate(12);
    }
}
