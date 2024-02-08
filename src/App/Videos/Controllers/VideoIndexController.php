<?php

namespace App\Videos\Controllers;

use App\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class VideoIndexController extends Page
{
    use WithPagination;
    use WithQueryBuilder;

    protected static string $model = Video::class;

    #[Url(as: 'q', history: true, except: '')]
    public string $search = '';

    #[Url(as: 't', history: true, except: [])]
    public array $tags = [];

    public QueryForm $form;

    public function mount(): void
    {
        $query = array_filter(
            $this->only('search', 'tags')
        );

        $this->form->restore();

        $this->form->fill($query);

        $this->form->submit();
    }

    public function render(): View
    {
        return view('videos.index');
    }

    public function updated(): void
    {
        $this->reset('search', 'tags');

        $this->resetPage();

        $this->form->submit();
    }

    public function clear(): void
    {
        $this->form->clear();

        $this->redirect(route('home'), true);
    }

    #[Computed]
    public function items(): Paginator
    {
        return $this->getQuery()
            ->recommended()
            ->when($this->form->getSearch(), fn (Builder $query, string $value) => $query->search($value))
            ->when($this->form->getTags(), fn (Builder $query, array $value) => $query->tagged($value))
            ->simplePaginate(32);
    }
}
