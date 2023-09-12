<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Concerns\WithFilters;
use App\Web\Search\Forms\SearchForm;
use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithVideos;
use Domain\Videos\Models\Video;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class SearchIndexController extends Component
{
    use WithFilters;
    use WithPagination;
    use WithTags;
    use WithVideos;

    public SearchForm $form;

    public function render(): View
    {
        return view('search::index', [
            'items' => $this->builder(),
        ]);
    }

    protected function builder(): Paginator
    {
        return Video::search($this->form->query ?: '*')
            ->query(fn (VideoQueryBuilder $query) => $query->with('tags'))
            ->paginate(24);
    }
}
