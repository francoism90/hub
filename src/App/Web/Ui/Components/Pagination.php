<?php

namespace App\Web\Ui\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Pagination extends Component
{
    public function render(): View
    {
        return view('layout.pagination');
    }
}