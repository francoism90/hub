<?php

namespace App\Web\Account\Controllers;

use App\Web\Videos\Components\Listing;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class HistoryController extends Listing
{
    public function mount(): void
    {
        parent::mount();

        SEOMeta::setTitle(__('History'));
    }

    public function render(): View
    {
        return view('account::history', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return Video::query()
            ->with('tags')
            ->history()
            // ->orderBy('name')
            // ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->take(12 * 6)
            ->paginate(12);
    }
}
