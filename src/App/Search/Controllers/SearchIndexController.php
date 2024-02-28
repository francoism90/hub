<?php

namespace App\Search\Controllers;

use App\Search\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Models\Concerns\WithQueryBuilder;
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

    public QueryForm $form;

    public function mount(): void
    {
        $this->form->restore();
    }

    public function render(): View
    {
        return view('search.index');
    }

    public function updated(): void
    {
        $this->form->submit();

        $this->resetPage();
    }

    public function clear(): void
    {
        $this->form->clear();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    public function getTitle(): string
    {
        return __('Search');
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        $value = $this->form->getSearch();

        return $this->getScout($value)
            ->when(blank($value), fn (Builder $query) => $query->whereIn('id', [0]))
            ->when($this->form->hasFeatures('caption'), fn (Builder $query) => $query->where('caption', true))
            ->when($this->form->isSort('longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'))
            ->when($this->form->isSort('shortest'), fn (Builder $query) => $query->orderBy('duration', 'asc'))
            ->when($this->form->isSort('released'), fn (Builder $query) => $query
                ->orderBy('released', 'desc')
                ->orderBy('created_at', 'desc')
            )
            ->paginate(32);
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
