<?php

namespace App\Web\Videos\Components;

use Domain\Videos\Models\Video;
use Illuminate\View\Component;
use Illuminate\View\View;

class Player extends Component
{
    public function __construct(
        public Video $video,
        public string $manifest = '',
        public bool $controls = true,
        public float $startsAt = 0,
    ) {
    }

    public function render(): View
    {
        return view('videos::player');
    }
}
