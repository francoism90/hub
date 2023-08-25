<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Container extends Component
{
    public function render(): View
    {
        return view('layouts::container');
    }
}
