<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class VideoIndexController extends Page
{
    use WithPagination;
    use WithQueryBuilder;

    #[Url(as: 'q', history: true, except: '')]
    public ?string $search = null;

    #[Url(as: 't', history: true, except: '')]
    public ?string $tag = null;

    protected static string $model = Video::class;

    public QueryForm $form;

    public function render(): View
    {
        return view('videos.index');
    }

    public function boot(): void
    {
        $query = array_filter(
            $this->only('search', 'tag')
        );

        $this->form->fill($query);

        $this->form->submit();
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        return $this->getQuery()
            ->recommended()
            ->when($this->getFormValue('search'), fn (Builder $query, string $value = '') => $query->search($value))
            ->when($this->getFormValue('tag'), fn (Builder $query, string $value = '') => $query->tagged((array) $value))
            ->paginate(16);
    }
}
