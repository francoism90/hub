<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Concerns\WithFeatures;
use App\Web\Search\Concerns\WithSorters;
use App\Web\Search\Forms\QueryForm;
use App\Web\Tags\Concerns\WithTags;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Models\Components\QueryBuilder;
use Foxws\LivewireUse\Views\Components\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class SearchIndexController extends Page
{
    use WithFeatures;
    use WithPagination;
    use WithSorters;
    use WithTags;

    protected static string $model = Video::class;

    public QueryForm $form;

    public function mount(): void
    {
        SEOMeta::setTitle(__('Search'));
    }

    public function render(): View
    {
        return view('search.index');
    }

    public function updatedForm(): void
    {
        $this->form->submit();
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
