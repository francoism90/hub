<?php

namespace App\Videos\Components;

use Domain\Videos\Models\Video;
use Foxws\LivewireUse\Views\Concerns\WithHash;
use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component
{
    use WithHash;

    public function __construct(
        public Video $item,
    ) {
    }

    public function render(): View
    {
        return view('videos.card');
    }
}
