<?php

namespace App\Web\Profile\Controllers;

use App\Web\Playlists\Concerns\WithHistory;
use App\Web\Profile\Concerns\WithAuthentication;
use App\Web\Videos\Components\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\WithPagination;

class HistoryController extends Listing
{
    use WithAuthentication;
    use WithHistory;

    public function mount(): void
    {
        SEOMeta::setTitle(__('History'));
    }

    public function render(): View
    {
        return view('profile::history', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return $this->getHistory()
            ->videos()
            ->with('tags')
            ->orderByDesc('videoables.updated_at')
            ->take(12 * 6)
            ->paginate(12);
    }
}
