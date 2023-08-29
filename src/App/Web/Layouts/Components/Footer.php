<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Footer extends Component
{
    public function render(): View
    {
        return view('layouts::footer');
    }
}
