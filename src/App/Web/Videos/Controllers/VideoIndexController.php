<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use App\Web\Videos\States\SortState;
use App\Web\Videos\States\TagState;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
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

    protected static array $states = [
        SortState::class,
        TagState::class,
    ];

    #[Url(as: 'q', history: true, except: '')]
    public ?string $search = null;

    #[Url(as: 't', history: true, except: '')]
    public ?array $tags = null;

    public QueryForm $form;

    public function render(): View
    {
        return view('videos.index');
    }

    public function mount(): void
    {
        $query = array_filter(
            $this->only('search', 'tags')
        );

        $this->form->restore();

        $this->form->fill($query);

        $this->form->submit();
    }

    public function updated(): void
    {
        $this->reset('search', 'tags');

        $this->resetPage();

        $this->form->submit();
    }

    #[Computed]
    public function items(): Paginator
    {
        return $this->getQuery()
            ->recommended()
            ->when($this->form->getSearch(), fn (Builder $query, string $value = '') => $query->search($value))
            ->when($this->form->getTags(), fn (Builder $query, array $value = []) => $query->tagged($value))
            ->simplePaginate(16);
    }
}
