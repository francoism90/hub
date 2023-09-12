<?php

namespace App\Web\Videos\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Filters extends Component
{
    public function render(): View
    {
        return view('videos::filters');
    }

    public function title(string $value): string
    {
        return str($value)->plural();
    }
}
