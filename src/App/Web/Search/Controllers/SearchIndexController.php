<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Concerns\WithFeatures;
use App\Web\Search\Concerns\WithHistory;
use App\Web\Search\Concerns\WithSorters;
use App\Web\Search\Forms\SearchForm;
use App\Web\Tags\Concerns\WithTags;
use App\Web\Videos\Concerns\WithVideos;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\QueryBuilder\Components\QueryBuilder;
use Foxws\LivewireUse\QueryBuilder\Concerns\WithScroll;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Attributes\Computed;

class SearchIndexController extends QueryBuilder
{
    use WithFeatures;
    use WithScroll;
    use WithSorters;
    use WithTags;

    protected static string $model = Video::class;

    public SearchForm $form;

    public function mount(): void
    {
        SEOMeta::setTitle(__('Search'));
    }

    public function render(): View
    {
        return view('search::index');
    }

    public function updatedForm(): void
    {
        $this->validate();

        $this->resetScroll();
    }

    #[Computed]
    public function builder(?int $page = null): LengthAwarePaginator
    {
        return Video::search($this->form->getSearch())
            ->when(! $this->form->hasSearch(), fn (Builder $query) => $query->whereIn('id', [0]))
            ->when($this->hasFeature('caption'), fn (Builder $query) => $query->where('caption', true))
            ->when($this->form->hasSort('longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'))
            ->when($this->form->hasSort('shortest'), fn (Builder $query) => $query->orderBy('duration', 'asc'))
            ->when($this->form->hasSort('released'), fn (Builder $query) => $query
                ->orderBy('released_at', 'desc')
                ->orderBy('created_at', 'desc')
            )
            ->take(12 * 48)
            ->paginate(perPage: 12, page: $page);
    }
}
