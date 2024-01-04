<?php

namespace App\Web\Search\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Filters extends Component
{
    public function render(): View
    {
        return view('search.filters');
    }

    public function sorters(): array
    {
        return [
            '' => __('Relevance'),
            'longest' => __('Longest'),
            'shortest' => __('Shortest'),
            'released' => __('Released'),
        ];
    }

    public function features(): array
    {
        return [
            'caption' => __('Captions'),
        ];
    }
}
