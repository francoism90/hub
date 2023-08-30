<?php

namespace App\Web\Filters\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Sort extends Component
{
    public function render(): View
    {
        return view('filters::sort');
    }
}
