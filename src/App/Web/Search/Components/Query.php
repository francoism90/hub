<?php

namespace App\Web\Search\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Query extends Component
{
    public function render(): View
    {
        return view('search::query');
    }
}
