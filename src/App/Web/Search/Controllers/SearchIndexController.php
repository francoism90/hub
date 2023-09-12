<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Components\Listing;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class SearchIndexController extends Listing
{
    public function render(): View
    {
        return view('search::index', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return Video::query()
            ->with('tags')
            ->published()
            ->when(filled($this->search), fn (Builder $query) => $query->search((string) $this->search))
            ->when(filled($this->sort), fn (Builder $query) => $query->sort((array) $this->sort))
            ->when(filled($this->tag), fn (Builder $query) => $query->tagged((array) $this->tag))
            ->paginate(24);
    }
}
