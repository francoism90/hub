<?php

namespace App\Web\Filters\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Applied extends Component
{
    public function render(): View
    {
        return view('filters::applied');
    }

    public function filters(...$filters): string
    {
        return implode(' + ', array_filter($filters));
    }
}
