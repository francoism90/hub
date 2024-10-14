<?php

namespace App\Web\Lists\Components;

use App\Web\Lists\Concerns\WithGroup;
use Illuminate\View\View;
use Livewire\Component;

class Group extends Component
{
    use WithGroup;

    public function render(): View
    {
        return view('app.lists.playlist.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.lists.playlist.placeholder', $params);
    }
}
