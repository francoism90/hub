<?php

namespace App\Web\Search\Controllers;

use App\Web\Search\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Concerns\WithForms;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Foxws\LivewireUse\Views\Components\Page;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class SearchIndexController extends Page
{
    use WithPagination;
    use WithQueryBuilder;

    protected static string $model = Video::class;

    public QueryForm $form;

    public function mount(): void
    {
        $this->seo()->setTitle(__('Search'));

        $this->form->restore();
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
    public function items(): LengthAwarePaginator
    {
        $value = $this->form->getSearch();

        return $this->getScout($value)
            ->when(! $this->form->hasSearch(), fn (Builder $query) => $query->whereIn('id', [0]))
            ->when($this->form->getTag(), fn (Builder $query, string $value = '') => $query->tagged((array) $value))
            // ->when($this->hasFeature('caption'), fn (Builder $query) => $query->where('caption', true))
            // ->when($this->form->hasSort('longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'))
            // ->when($this->form->hasSort('shortest'), fn (Builder $query) => $query->orderBy('duration', 'asc'))
            // ->when($this->form->hasSort('released'), fn (Builder $query) => $query
                // ->orderBy('released_at', 'desc')
                // ->orderBy('created_at', 'desc')
            // )
            ->take(12 * 48)
            ->paginate(12);
    }
}
