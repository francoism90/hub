<?php

namespace App\Web\Ui\Components;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
        return $this->items instanceof LengthAwarePaginator
            ? view('layout.pagination')
            : view('layout.simple-pagination');
    }
}
