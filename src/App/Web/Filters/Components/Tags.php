<?php

namespace App\Web\Filters\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Tags extends Component
{
    public function render(): View
    {
        return view('filters::tags');
    }

    public function title(string $value): string
    {
        return str($value)->plural();
    }
}
