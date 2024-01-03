<?php

namespace App\Web\Videos\Controllers;

use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Components\Page;
use Foxws\LivewireUse\Views\Concerns\WithQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

class VideoIndexController extends Page
{
    use WithQueryBuilder;

    protected static string $model = Video::class;

    // public QueryForm $form;

    public function render(): View
    {
        return view('videos.index');
    }

    public function items(): LengthAwarePaginator
    {
        return $this->getQuery()
            ->paginate(12);
    }
}
