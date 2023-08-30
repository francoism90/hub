<?php

namespace App\Web\Account\Controllers;

use App\Web\Videos\Components\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;

class WatchlistController extends Listing
{
    public function mount(): void
    {
        parent::mount();

        SEOMeta::setTitle(__('Watchlist'));
    }

    public function render(): View
    {
        return view('account::watchlist', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return Playlist::query()
            ->watchlist()
            ->first()
            ->videos()
            ->with('tags')
            ->orderByDesc('videoables.updated_at')
            ->take(12 * 6)
            ->paginate(12);
    }
}
