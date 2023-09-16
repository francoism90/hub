<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Concerns\WithFeatures;
use App\Web\Search\Concerns\WithHistory;
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
    use WithFeatures;
    use WithHistory;
    use WithPagination;
    use WithScroll;
    use WithSorters;
    use WithTags;
    use WithVideos;

    public SearchForm $form;

    public function mount(): void
    {
        if (session()->has('search')) {
            $this->form->query = (string) session()->get('search.query');
            $this->form->feature = (array) session()->get('search.feature');
            $this->form->sort = (string) session()->get('search.sort');
        }
    }

    public function render(): View
    {
        return view('search::index');
    }

    public function updated(): void
    {
        $this->reset('items');

        $this->validate();

        $this->resetPage();

        $this->storeForm();
    }

    protected function builder(int $page = null): LengthAwarePaginator
    {
        return Video::search($this->form->query ?: '*')
            ->query(fn (VideoQueryBuilder $query) => $query->with('media', 'tags'))
            ->when($this->hasFeature('caption'), fn (Builder $query) => $query->where('caption', true))
            ->when($this->hasSort('longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'))
            ->when($this->hasSort('shortest'), fn (Builder $query) => $query->orderBy('duration', 'asc'))
            ->when($this->hasSort('released'), fn (Builder $query) => $query
                ->orderBy('released_at', 'desc')
                ->orderBy('created_at', 'desc')
            )
            ->take(8 * 12)
            ->paginate(perPage: 8, page: $page);
    }
}
