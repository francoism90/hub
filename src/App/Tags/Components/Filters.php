<?php

namespace App\Tags\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Filters extends Component
{
    public function render(): View
    {
        return view('tags.filters');
    }
}
