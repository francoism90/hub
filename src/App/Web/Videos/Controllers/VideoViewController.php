<?php

namespace App\Web\Videos\Controllers;

use Domain\Videos\Models\Video;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\View\View;
use Livewire\Component;
use App\Web\Videos\Concerns\WithVideo;

class VideoViewController extends Component
{
    use WithVideo;

    // public function boot(): void
    // {
    //     // $this->authorize('view', $this->video);
    // }

    public function render(): View
    {
        return view('videos::view');
    }
}
