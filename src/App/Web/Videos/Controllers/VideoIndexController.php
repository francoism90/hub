<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Components\Listing;
use App\Web\Videos\Concerns\WithTags;
use Domain\Videos\Models\Video;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class VideoIndexController extends Listing
{
    use WithTags;

    protected static string $model = Video::class;

    public function render(): View
    {
        return view('videos::index');
    }

    #[Computed]
    public function builder(): Paginator
    {
        return Video::query()
            ->recommended()
            ->when($this->hasTags(), fn (Builder $query) => $query->tagged($this->tags))
            ->take(32 * 32)
            ->simplePaginate(32);
    }
}
