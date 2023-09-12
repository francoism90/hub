<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Concerns\WithScroll;
use App\Web\Search\Concerns\WithSorters;
use App\Web\Search\Forms\SearchForm;
use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithVideos;
use Domain\Videos\Models\Video;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class SearchIndexController extends Component
{
    use WithPagination;
    use WithScroll;
    use WithSorters;
    use WithTags;
    use WithVideos;

    public SearchForm $form;

    public function render(): View
    {
        return view('search::index', [
            'firstPage' => $this->builder()->onFirstPage(),
            'lastPage' => $this->builder()->onLastPage(),
        ]);
    }

    public function updated(): void
    {
        $this->reset('items');

        $this->resetPage();

        $this->validate();
    }

    protected function builder(int $page = null): LengthAwarePaginator
    {
        return Video::search($this->form->query ?: '*')
            ->query(fn (VideoQueryBuilder $query) => $query->with('tags'))
            ->when($this->hasSort('longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'))
            ->when($this->hasSort('shortest'), fn (Builder $query) => $query->orderBy('duration', 'asc'))
            ->take(12 * 5)
            ->paginate(perPage: 12, page: $page);
    }
}
