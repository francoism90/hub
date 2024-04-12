<?php

namespace App\Profile\Controllers;

use App\Playlists\Concerns\WithFavorites;
use Foxws\WireUse\Views\Components\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class FavoritesController extends Page
{
    use WithFavorites;
    use WithPagination;

    public function mount(): void
    {
        $this->seo()->setTitle(__('Favorites'));
        $this->seo()->setDescription(__('Your Favorites'));
    }

    public function render(): View
    {
        return view('playlists.view');
    }

    #[Computed]
    public function items(): Paginator
    {
        return static::favorites()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->simplePaginate(32);
    }

    public function getListeners(): array
    {
        $id = static::favorites()->getRouteKey();

        return [
            "echo-private:playlist.{$id},.playlist.deleted" => 'refresh',
            "echo-private:playlist.{$id},.playlist.updated" => 'refresh',
        ];
    }
}
