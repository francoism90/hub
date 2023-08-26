<?php

namespace App\Web\Videos\Components;

use App\Web\Videos\Concerns\WithFilters;
use Illuminate\View\View;
use Livewire\Component;

class Filters extends Component
{
    use WithFilters;

    public function render(): View
    {
        return view('videos::filters');
    }
}
