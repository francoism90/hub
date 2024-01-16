<?php

namespace App\Videos\Components;

use Domain\Tags\Collections\TagCollection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Tags extends Component
{
    public function __construct(
        public TagCollection $items,
    ) {
    }

    public function render(): View
    {
        return view('videos.tags');
    }
}
