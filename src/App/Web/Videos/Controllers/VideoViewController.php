<?php

namespace App\Web\Videos\Controllers;

use Illuminate\View\View;
use Livewire\Component;
use App\Web\Videos\Concerns\WithVideo;

class VideoViewController extends Component
{
    use WithVideo;

    public function render(): View
    {
        return view('videos::view');
    }
}
