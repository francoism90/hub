<?php

namespace App\Livewire\Dashboard\Content;

use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Videos extends Component
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
        return view('livewire.dashboard.content.videos')->with([
            'filters' => $this->filters(),
        ]);
    }

    public function updated(): void
    {
        $this->form->submit();

        $this->refresh();

        $this->resetPage();
    }

    public function clear(): void
    {
        $this->form->forget();

        $this->form->clear();
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
            // ->when($this->form->contains('features', 'caption'), fn (Builder $query) => $query->where('caption', true))
            // ->when($this->form->is('sort', 'longest'), fn (Builder $query) => $query->orderBy('duration', 'desc'))
            // ->when($this->form->is('sort', 'shortest'), fn (Builder $query) => $query->orderBy('duration', 'asc'))
            // ->when($this->form->is('sort', 'released'), fn (Builder $query) => $query
            //     ->orderBy('released', 'desc')
            //     ->orderBy('created_at', 'desc')
            // )
            ->paginate(32);
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    public function getListeners(): array
    {
        return [];
    }

    protected function filters(): ActionGroup
    {
        return ActionGroup::make()
            ->add('sort', fn (Action $item) => $item
                ->label(__('Sort by'))
                ->icon('heroicon-s-chevron-down')
                ->component('dashboard.videos.filters.sort')
                ->add('recent', fn (Action $item) => $item->label('Most recent (default)'))
                ->add('random', fn (Action $item) => $item->label('Most watched'))
            );
    }
}
