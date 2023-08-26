<?php

namespace App\Web\Videos\Components;

use Domain\Videos\Models\Video;
use Illuminate\View\Component;
use Illuminate\View\View;

class Player extends Component
{
    public function __construct(
        public Video $model,
        public string $manifest,
        public bool $controls = true,
    ) {
    }

    public function render(): View
    {
        return view('videos::player');
    }
}
