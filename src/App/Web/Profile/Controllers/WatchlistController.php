<?php

namespace App\Web\Profile\Controllers;

use App\Web\Playlists\Concerns\WithWatchlist;
use App\Web\Profile\Concerns\WithAuthentication;
use App\Web\Videos\Components\Listing;
use App\Web\Videos\Concerns\WithSearch;
use App\Web\Videos\Concerns\WithSorters;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class WatchlistController extends Listing
{
    use WithAuthentication;
    use WithSearch;
    use WithSorters;
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

    #[Computed]
    public function sorters(): array
    {
        return [
            '' => __('Date added (newest)'),
            'oldest' => __('Date added (oldest)'),
            'published' => __('Date published'),
        ];
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
            ->when($this->hasSearch(), fn (Builder $query) => $query->search($this->query, true))
            ->take(24 * 10)
            ->paginate(24);
    }
}
