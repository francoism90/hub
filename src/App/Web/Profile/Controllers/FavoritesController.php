<?php

namespace App\Web\Profile\Controllers;

use App\Web\Playlists\Concerns\WithFavorites;
use App\Web\Profile\Concerns\WithAuthentication;
use App\Web\Videos\Components\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class FavoritesController extends Listing
{
    use WithAuthentication;
    use WithFavorites;

    public function mount(): void
    {
        SEOMeta::setTitle(__('Favorites'));
    }

    public function render(): View
    {
        return view('profile::list', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return $this->getFavorites()
            ->videos()
            ->with('tags')
            ->orderByDesc('videoables.updated_at')
            ->when($this->hasSort('oldest'), fn (Builder $query) => $query->reorder()->orderBy('videoables.updated_at'))
            ->when($this->hasSort('published'), fn (Builder $query) => $query->reorder()->orderByDesc('created_at'))
            ->when(filled($this->tag), fn (Builder $query) => $query->tagged((array) $this->tag))
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->take(24 * 6)
            ->paginate(24);
    }
}
