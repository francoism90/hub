<?php

namespace App\Web\Search\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\Component;
use Illuminate\View\View;

class Items extends Component
{
    public function __construct(
        public Builder $items,
    ) {
    }

    public function render(): View
    {
        return view('search::items');
    }
}
