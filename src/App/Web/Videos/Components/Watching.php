<?php

namespace App\Web\Videos\Components;

use Domain\Playlists\Models\Playlist;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;

#[Lazy]
class Watching extends Section
{
    #[Computed]
    public function items(): Collection
    {
        $playlist = Playlist::findByName(auth()->user(), 'history');

        $this->authorize('view', $playlist);

        return $playlist->videos()
            ->published()
            ->orderByDesc('videoables.created_at')
            ->take(16)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Continue Watching');
    }
}
