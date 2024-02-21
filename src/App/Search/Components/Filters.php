<?php

namespace App\Search\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Filters extends Component
{
    public function render(): View
    {
        return view('search.filters');
    }

    public function features(): array
    {
        return [
            'caption' => __('Captions'),
        ];
    }
}
