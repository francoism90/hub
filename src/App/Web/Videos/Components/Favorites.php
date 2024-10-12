<?php

namespace App\Web\Videos\Components;

use Domain\Playlists\Models\Playlist;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Favorites extends Section
{
    public function boot(): void
    {
        $this->authorize('view', $this->getPlaylist());
    }

    #[Computed(persist: true, seconds: 60 * 20)]
    public function items(): Collection
    {
        return $this->getPlaylist()
            ->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->take(24)
            ->get();
    }

    protected function getTitle(): ?string
    {
        return __('Favorites');
    }

    protected function getPlaylist(): ?Playlist
    {
        return $this->getAuthModel()->playlists()->favorites();
    }

    public function getListeners(): array
    {
        $id = $this->getAuthKey();

        return [
            "echo-private:user.{$id},.playlist.trashed" => 'refresh',
            "echo-private:user.{$id},.playlist.updated" => 'refresh',
            "echo-private:user.{$id},.video.trashed" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
