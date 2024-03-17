<?php

namespace App\Profile\Controllers;

use App\Playlists\Concerns\WithHistory;
use App\Videos\Controllers\VideoIndexController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\Computed;

class HistoryController extends VideoIndexController
{
    use WithHistory;

    public function mount(): void
    {
        $this->seo()->setTitle(__('History'));
        $this->seo()->setDescription(__('Your Watchlist'));
    }

    #[Computed]
    public function items(): Paginator
    {
        return static::history()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->when($this->form->is('sort', 'oldest'), fn (Builder $query) => $query->reorder()->orderBy('videoables.updated_at'))
            ->when($this->form->is('sort', 'published'), fn (Builder $query) => $query->reorder()->orderByDesc('created_at'))
            ->when($this->form->get('search'), fn (Builder $query, string $value) => $query->search($value, true))
            ->when($this->form->get('tags'), fn (Builder $query, array $value) => $query->tagged($value))
            ->take(32 * 32)
            ->simplePaginate(32);
    }
}
