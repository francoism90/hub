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
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class SearchIndexController extends Page
{
    use WithPagination;
    use WithQueryBuilder;

    #[Url(as: 'q', history: true, except: '')]
    public string $search = '';

    #[Url(as: 's', history: true, except: '')]
    public string $sort = '';

    #[Url(as: 't', history: true, except: [])]
    public array $features = [];

    public QueryForm $form;

    public function mount(): void
    {
        $this->seo()->setTitle(__('Search'));

        $this->populate();
    }

    public function render(): View
    {
        return view('search.index');
    }

    public function updated(): void
    {
        $this->populate();

        $this->resetPage();
    }

    public function populate(): void
    {
        $this->form->fill(
            $this->only('search', 'sort', 'features')
        );

        if ($this->form->fails()) {
            $this->clear();
        }

        $this->form->submit();
    }

    public function clear(): void
    {
        $this->form->clear();

        $this->redirectRoute('search', navigate: true);
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
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
