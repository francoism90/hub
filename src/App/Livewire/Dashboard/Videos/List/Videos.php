<?php

namespace App\Livewire\Dashboard\Videos\List;

use App\Livewire\Dashboard\Videos\Forms\QueryForm;
use App\Livewire\Dashboard\Videos\Scopes\ListVideos;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
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
    public function items(): Paginator
    {
        $query = $this->form->query();

        return $this->getScout($query)->tap(
            new ListVideos(form: $this->form)
        )->simplePaginate(12 * 3);
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

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.video.deleted" => '$refresh',
            "echo-private:user.{$id},.video.updated" => '$refresh',
        ];
    }
}
