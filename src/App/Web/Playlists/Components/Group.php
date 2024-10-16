<?php

declare(strict_types=1);

namespace App\Web\Playlists\Components;

use App\Web\Playlists\Concerns\WithGroup;
use Illuminate\View\View;
use Livewire\Component;

class Group extends Component
{
    use WithGroup;

    public function render(): View
    {
        return view('app.playlists.group.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.playlists.group.placeholder', $params);
    }
}
