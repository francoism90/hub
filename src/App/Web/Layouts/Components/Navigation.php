<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Navigation extends Component
{
    public function render(): View
    {
        return view('layouts::navigation');
    }
}
