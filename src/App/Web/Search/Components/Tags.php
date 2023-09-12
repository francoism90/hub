<?php

namespace App\Web\Search\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Tags extends Component
{
    public function render(): View
    {
        return view('search::tags');
    }

    public function title(string $value): string
    {
        return str($value)->plural();
    }
}
