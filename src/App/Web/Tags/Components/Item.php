<?php

namespace App\Web\Tags\Components;

use Domain\Tags\Models\Tag;
use Illuminate\View\Component;
use Illuminate\View\View;

class Item extends Component
{
    public function __construct(
        public Tag $item,
    ) {}

    public function render(): View
    {
        return view('tags::item');
    }
}
