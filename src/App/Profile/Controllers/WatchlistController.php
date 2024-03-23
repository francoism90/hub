<?php

namespace App\Profile\Controllers;

use App\Playlists\Concerns\WithWatchlist;
use App\Videos\Controllers\VideoIndexController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\Computed;

class WatchlistController extends VideoIndexController
{
    use WithWatchlist;

    public function mount(): void
    {
        $this->seo()->setTitle(__('Watchlist'));
        $this->seo()->setDescription(__('Your Watchlist'));
    }

    #[Computed(persist: true, seconds: 300)]
    public function items(): Paginator
    {
        return static::watchlist()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->when($this->form->is('sort', 'oldest'), fn (Builder $query) => $query->reorder()->orderBy('videoables.updated_at'))
            ->when($this->form->is('sort', 'published'), fn (Builder $query) => $query->reorder()->orderByDesc('created_at'))
            ->when($this->form->get('search'), fn (Builder $query, string $value) => $query->search($value, scopes: true))
            ->when($this->form->get('tags'), fn (Builder $query, array $value) => $query->tagged($value))
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
