<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Pagination extends Component
{
    public function __construct(
        public $items,
    ) {
    }

    public function render(): View
    {
        return view('layouts::pagination');
    }
}
