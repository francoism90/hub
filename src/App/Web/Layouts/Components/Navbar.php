<?php

namespace App\Web\Layouts\Components;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class Navbar extends Component
{
    #[Reactive]
    public ?string $tag = null;

    #[Reactive]
    public ?string $search = null;

    public function render(): View
    {
        return view('layouts::navbar');
    }
}
