<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Dropdown extends Component
{
    public function render(): View
    {
        return view('layouts::dropdown');
    }
}
