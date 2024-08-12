<?php

namespace App\Web\Lists\Components;

use App\Web\Tags\Concerns\WithTag;
use Illuminate\View\View;
use Livewire\Component;

class Tag extends Component
{
    use WithTag;

    public function render(): View
    {
        return view('app.lists.tag.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.lists.tag.placeholder', $params);
    }
}
