<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Illuminate\View\View;
use Livewire\Component;

class Item extends Component
{
    use WithVideo;

    public function render(): View
    {
        return view('app.videos.card.item')->with([
            // 'title' => $this->getTitle(),
            // 'description' => $this->getDescription(),
        ]);
    }

    public function placeholder(array $params = [])
    {
        return view('app.videos.section.placeholder', $params);
    }
}
