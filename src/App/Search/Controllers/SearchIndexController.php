<?php

namespace App\Search\Controllers;

use App\Search\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
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

    public function updated(): void
    {
        $this->resetPage();

        $this->form->submit();
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        $value = $this->form->getSearch();

        return $this->getScout($value)
            ->when(! $this->form->hasSearch(), fn (Builder $query) => $query->whereIn('id', [0]))
            ->when($this->form->getTags(), fn (Builder $query, array $value = []) => $query->tagged((array) $value))
            ->when($this->form->hasFeatures('caption'), fn (Builder $query) => $query->where('caption', true))
            ->when($this->form->isSort('longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'))
            ->when($this->form->isSort('shortest'), fn (Builder $query) => $query->orderBy('duration', 'asc'))
            ->when($this->form->isSort('released'), fn (Builder $query) => $query
                ->orderBy('released', 'desc')
                ->orderBy('created_at', 'desc')
            )
            ->take(32 * 52)
            ->paginate(32);
    }
}
