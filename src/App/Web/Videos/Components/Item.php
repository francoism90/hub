<?php

declare(strict_types=1);

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithVideo;
use Illuminate\View\View;
use Livewire\Component;

class Item extends Component
{
    use WithVideo;

    public function render(): View
    {
        return view('app.videos.card.item');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.videos.card.placeholder', $params);
    }
}
