<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Forms\QueryForm;
use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoIndexController extends Page
{
    use WithQueryBuilder;

    protected static string $model = Video::class;

    public QueryForm $form;

    public function render(): View
    {
        return view('videos.index');
    }

    #[Computed(cache: true, key: 'recommended')]
    public function items(): LengthAwarePaginator
    {
        return $this->getQuery()
            ->paginate(12);
    }
}
