<?php

namespace App\Web\Playlists\Controllers;

use App\Web\Playlists\Concerns\WithPlaylists;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PlaylistIndexController extends Component
{
    use WithPlaylists;

    public function mount(): void
    {
        SEOMeta::setTitle(__('Playlists'));
    }

    public function render(): View
    {
        return view('playlists::index');
    }

    #[Computed()]
    public function items(): Collection
    {
        return collect();
    }
}
