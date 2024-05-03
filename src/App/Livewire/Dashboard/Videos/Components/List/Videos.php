<?php

namespace App\Livewire\Dashboard\Videos\Components\List;

use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
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
        return view('livewire.dashboard.videos.list.grid')->with([
            'actions' => $this->actions(),
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
        $value = $this->form->query();

        return $this->getScout($value)
            ->when($this->form->isStrict('sort', 'recommended'), fn (Builder $query) => $query->whereIn('id', static::getRandomKeys()))
            ->when($this->form->isStrict('sort', 'recent'), fn (Builder $query) => $query->orderBy('created_at', 'desc'))
            ->when($this->form->isStrict('sort', 'updated'), fn (Builder $query) => $query->orderBy('updated_at', 'desc'))
            ->when($this->form->get('visibility'), fn (Builder $query, array $state) => $query->whereIn('state', $state))
            ->paginate(10 * 3);
    }

    protected function actions(): array
    {
        return [
            Action::make('filter')
                ->label(__('Filter'))
                ->icon('heroicon-s-adjustments-horizontal')
                ->component('dashboard.videos.filters.filter')
                ->componentAttributes([
                    'class:label' => 'sr-only',
                ]),

            Action::make('sort')
                ->label(__('Sort by'))
                ->component('dashboard.videos.filters.sort')
                ->addIf('relevance', filled($this->form->query()), fn (Action $item) => $item->label('Relevance'))
                ->add('recommended', fn (Action $item) => $item->label('Recommended'))
                ->add('recent', fn (Action $item) => $item->label('Most recent'))
                ->add('updated', fn (Action $item) => $item->label('Recently updated')),

            Action::make('visible')
                ->label(__('Visibility'))
                ->component('dashboard.videos.filters.visibility')
                ->add('verified', fn (Action $item) => $item->label('Verified'))
                ->add('pending', fn (Action $item) => $item->label('Pending'))
                ->add('failed', fn (Action $item) => $item->label('Failed')),
        ];
    }

    protected static function getModelClass(): ?string
    {
        return Video::class;
    }

    protected static function getRandomKeys(): array
    {
        return static::getQuery()
            ->random()
            ->take(12 * 5)
            ->get()
            ->modelKeys();
    }

    public function getListeners(): array
    {
        return [];
    }
}
