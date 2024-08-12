<?php

namespace App\Web\Lists\Components;

use App\Web\Lists\Concerns\WithPlaylist;
use Illuminate\View\View;
use Livewire\Component;

class Playlist extends Component
{
    use WithPlaylist;

    public function render(): View
    {
        return view('app.lists.playlist.view');
    }

    public function placeholder(array $params = []): View
    {
        return view('app.lists.playlist.placeholder', $params);
    }
}
