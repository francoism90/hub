<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Dialog extends Component
{
    public function render(): View
    {
        return view('layouts::dialog');
    }
}
