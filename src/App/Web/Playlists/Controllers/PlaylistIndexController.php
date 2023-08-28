<?php

namespace App\Web\Playlists\Controllers;

use App\Web\Playlists\Concerns\WithPlaylists;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Tags\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PlaylistIndexController extends Component
{
    use WithPlaylists;

    public function mount(): void
    {
        SEOMeta::setTitle(__('Tags'));
    }

    public function render(): View
    {
        return view('tags::index');
    }

    #[Computed()]
    public function items(): Collection
    {
        return Tag::query()
            ->withCount('videos')
            ->orderByDesc('videos_count')
            ->get();
    }
}
