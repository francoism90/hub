<?php

namespace App\Livewire\Dashboard\Content;

use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\ActionGroup;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Laravel\Scout\Builder;
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

        $this->resetPage();
    }

    public function clear(): void
    {
        $this->form->forget();

        $this->form->clear();
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        $value = $this->form->getSearch();

        return $this->getScout($value)
            ->when($this->form->isStrict('sort', 'recent'), fn (Builder $query) => $query->orderBy('created_at', 'desc'))
            ->when($this->form->isStrict('sort', 'updated'), fn (Builder $query) => $query->orderBy('updated_at', 'desc'))
            ->when($this->form->get('visibility'), fn (Builder $query, array $state) => $query->whereIn('state', $state))
            ->paginate(12 * 3);
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
                ->add('recent', fn (Action $item) => $item->label('Most recent'))
                ->add('updated', fn (Action $item) => $item->label('Recently updated'))
            )
            ->add('state', fn (Action $item) => $item
                ->label(__('Visibility'))
                ->icon('heroicon-s-chevron-down')
                ->component('dashboard.videos.filters.visibility')
                ->add('verified', fn (Action $item) => $item->label('Verified'))
                ->add('pending', fn (Action $item) => $item->label('Pending'))
                ->add('failed', fn (Action $item) => $item->label('Failed'))
            );
    }
}
