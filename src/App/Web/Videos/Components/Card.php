<?php

namespace App\Web\Videos\Components;

use Domain\Videos\Models\Video;
use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component
{
    public function __construct(
        public Video $item,
    ) {
    }

    public function render(): View
    {
        return view('videos::card');
    }
}
