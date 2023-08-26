<?php

namespace App\Web\Videos\Controllers;

use App\Web\Videos\Concerns\WithVideo;
use Illuminate\View\View;
use Livewire\Component;

class VideoViewController extends Component
{
    use WithVideo;

    public function render(): View
    {
        return view('videos::view');
    }
}
