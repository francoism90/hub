<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Queries extends Component
{
    public function render(): View
    {
        return view('layouts::queries');
    }
}
