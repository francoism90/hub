<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Illuminate\View\View;
use Livewire\Component;

class Player extends Component
{
    use WithVideo;

    public function render(): View
    {
        return view('app.videos.player.ui')->with([
            // 'title' => $this->getTitle(),
            // 'description' => $this->getDescription(),
        ]);
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.player.placeholder', $params);
    }
}
