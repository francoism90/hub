<?php

namespace App\Web\Videos\Controllers;

use Domain\Videos\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class VideoIndexController extends Component
{
    public function boot(): void
    {
        $this->authorize('viewAny', Video::class);
    }

    public function render(): View
    {
        return view('videos::index');
    }
}
