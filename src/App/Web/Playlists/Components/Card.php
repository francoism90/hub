<?php

namespace App\Web\Playlists\Components;

use Domain\Playlists\Models\Playlist;
use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component
{
    public function __construct(
        public Playlist $item,
    ) {
    }

    public function render(): View
    {
        return view('playlists::card');
    }
}
