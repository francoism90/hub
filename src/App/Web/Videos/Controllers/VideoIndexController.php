<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithForms;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoIndexController extends Page
{
    use WithForms;
    use WithQueryBuilder;

    protected static string $model = Video::class;

    public QueryForm $form;

    public function render(): View
    {
        return view('videos.index');
    }

    #[Computed]
    public function items(): LengthAwarePaginator
    {
        return $this->getQuery()
            ->recommended()
            ->when($this->getFormValue('search'), fn (Builder $query, string $value) => $query->search($value))
            ->when($this->getFormValue('tags'), fn (Builder $query, array $value) => $query->tagged($value))
            ->paginate(12);
    }
}
