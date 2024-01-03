<?php

namespace App\Web\Ui\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SimplePagination extends Component
{
    public function render(): View
    {
        return view('layout.simple-pagination');
    }
}
