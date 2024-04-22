<?php

namespace App\Profile\Controllers;

use App\Playlists\Concerns\WithHistory;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class HistoryController extends Page
{
    use WithHistory;
    use WithPagination;

    public function mount(): void
    {
        $this->seo()->setTitle(__('History'));
        $this->seo()->setDescription(__('Your Watchlist'));
    }

    public function render(): View
    {
        return view('playlists.view');
    }

    #[Computed]
    public function items(): Paginator
    {
        return static::history()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->simplePaginate(32);
    }

    public function getListeners(): array
    {
        $id = static::history()->getRouteKey();

        return [
            "echo-private:playlist.{$id},.playlist.deleted" => 'refresh',
            "echo-private:playlist.{$id},.playlist.updated" => 'refresh',
        ];
    }
}
