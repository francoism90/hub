<?php

namespace App\Web\Videos\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Search extends Component
{
    public function render(): View
    {
        return view('videos::search');
    }
}
