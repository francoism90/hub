<?php

namespace App\Profile\Controllers;

use App\Playlists\Concerns\WithWatchlist;
use App\Videos\Controllers\VideoIndexController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class WatchlistController extends VideoIndexController
{
    use WithWatchlist;

    public function mount(): void
    {
        $this->seo()->setTitle(__('Watchlist'));
        $this->seo()->setDescription(__('Your Watchlist'));
    }

    public function render(): View
    {
        return view('playlists.view');
    }

    #[Computed]
    public function items(): Paginator
    {
        return static::watchlist()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->take(32 * 32)
            ->simplePaginate(32);
    }

    public function getListeners(): array
    {
        $id = static::watchlist()->getRouteKey();

        return [
            "echo-private:playlist.{$id},.playlist.deleted" => 'refresh',
            "echo-private:playlist.{$id},.playlist.updated" => 'refresh',
        ];
    }
}
