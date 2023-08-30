<?php

namespace App\Web\Layouts\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class Pagination extends Component
{
    public function __construct(
        public Paginator $items,
    ) {
    }

    public function render(): View
    {
        return view('layouts::pagination');
    }
}
