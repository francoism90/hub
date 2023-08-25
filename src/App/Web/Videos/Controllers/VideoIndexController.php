<?php

namespace App\Web\Videos\Controllers;

use Domain\Videos\Models\Video;
use Livewire\Component;

class VideoIndexController extends Component
{
    public function boot()
    {
        $this->authorize('viewAny', Video::class);
    }

    public function render()
    {
        return view('videos::index');
    }
}
