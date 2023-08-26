<?php

namespace App\Web\Layouts\Components;

use App\Web\Videos\Concerns\WithFilters;
use Illuminate\View\View;
use Livewire\Component;

class Navbar extends Component
{
    use WithFilters;

    public function render(): View
    {
        return view('layouts::navbar');
    }
}
