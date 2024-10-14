<?php

declare(strict_types=1);

namespace App\Web\Groups\Components;

use App\Web\Groups\Concerns\WithGroup;
use Illuminate\View\View;
use Livewire\Component;

class Group extends Component
{
    use WithGroup;

    public function render(): View
    {
        return view('app.groups.playlist.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.groups.playlist.placeholder', $params);
    }
}
