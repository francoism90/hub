<?php

namespace App\Web\Search\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class Items extends Component
{
    public function __construct(
        public Paginator $items,
    ) {
    }

    public function render(): View
    {
        return view('search::items');
    }
}
