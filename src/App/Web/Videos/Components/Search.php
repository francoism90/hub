<?php

namespace App\Web\Videos\Components;

use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public ?string $search = null;

    public function render(): View
    {
        return view('videos::search');
    }
}
