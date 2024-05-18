<?php

namespace App\Livewire\Dashboard\Videos\List;

use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Laravel\Scout\Builder as Scout;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Videos extends Component
{
    use WithAuthentication;
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
            ->query(fn (Builder $query) => $this->form->filled('untagged')
                ? $query->whereDoesntHave('tags')
                : $query->with('tags')
            )
            ->when($this->form->blank('query', 'sort'), fn (Scout $query) => $query->whereIn('id', static::getRandomKeys()))
            ->when($this->form->isStrict('sort', 'recent'), fn (Scout $query) => $query->orderBy('created_at', 'desc'))
            ->when($this->form->isStrict('sort', 'updated'), fn (Scout $query) => $query->orderBy('updated_at', 'desc'))
            ->when($this->form->get('visibility'), fn (Scout $query, array $value) => $query->whereIn('state', $value))
            ->paginate(12 * 3);
    }

    protected function actions(): array
    {
        return [
            Action::make('filter')
                ->label(__('Filter'))
                ->icon('heroicon-s-adjustments-horizontal')
                ->component('dashboard.videos.filters.filter')
                ->add('untagged', fn (Action $item) => $item->label('Untagged'))
                ->componentAttributes([
                    'class:label' => 'sr-only',
                ]),

            Action::make('sort')
                ->label(__('Sort by'))
                ->component('dashboard.videos.filters.sort')
                ->add('relevance', fn (Action $item) => $item->label('Relevance'))
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
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => '$refresh',
            "echo-private:user.{$id},.video.updated" => '$refresh',
        ];
    }
}
