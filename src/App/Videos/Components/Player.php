<?php

namespace App\Videos\Components;

use Domain\Videos\Models\Video;
use Illuminate\View\Component;
use Illuminate\View\View;

class Player extends Component
{
    public function __construct(
        public Video $item,
        public string $manifest = '',
        public bool $controls = true,
        public float $rate = 1.0,
        public float $startsAt = 0,
    ) {
    }

    public function render(): View
    {
        return view('videos.player');
    }
}
