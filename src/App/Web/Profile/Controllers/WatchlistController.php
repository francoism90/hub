<?php

namespace App\Web\Profile\Controllers;

use App\Web\Playlists\Concerns\WithWatchlist;
use App\Web\Profile\Concerns\WithAuthentication;
use App\Web\Videos\Components\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class WatchlistController extends Listing
{
    use WithAuthentication;
    use WithWatchlist;

    public function mount(): void
    {
        SEOMeta::setTitle(__('Watchlist'));
    }

    public function render(): View
    {
        return view('videos::index', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return $this->getWatchlist()
            ->videos()
            ->with('tags')
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->when($this->hasSort('oldest'), fn (Builder $query) => $query->reorder()->orderBy('videoables.updated_at'))
            ->when($this->hasSort('published'), fn (Builder $query) => $query->reorder()->orderByDesc('created_at'))
            ->when(filled($this->tags), fn (Builder $query) => $query->tagged($this->tags))
            ->when(filled($this->search), fn (Builder $query) => $query->search($this->search, true))
            ->take(24 * 6)
            ->paginate(24);
    }
}
