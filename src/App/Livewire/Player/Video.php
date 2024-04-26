<?php

namespace App\Livewire\Player;

use App\Livewire\App\Videos\Concerns\WithVideo;
use Illuminate\View\View;
use Livewire\Component;

class Video extends Component
{
    use WithVideo;

    public function render(): View
    {
        return view('livewire.app.player.video')->with([
            // 'controls' => $this->controls(),
        ]);
    }
}
