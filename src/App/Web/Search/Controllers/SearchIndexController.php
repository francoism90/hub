<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Components\Listing;
use Domain\Videos\Models\Video;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
use Illuminate\Contracts\Pagination\Paginator;
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
        return Video::search($this->search)
            ->query(fn (VideoQueryBuilder $query) => $query->with('tags'))
            ->paginate(24);
    }
}
