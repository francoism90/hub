<?php

namespace App\Web\Videos\Components;

use Domain\Playlists\Models\Playlist;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Watchlist extends Section
{
    public function boot(): void
    {
        $this->authorize('view', $this->getPlaylist());
    }

    #[Computed(persist: true)]
    public function items(): Collection
    {
        return $this->getPlaylist()
            ->videos()
            ->published()
            ->randomSeed('videos-watchlist', 60 * 10)
            ->take(24)
            ->get();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getTitle(): ?string
    {
        return __('On Watchlist');
    }

    protected function getPlaylist(): Playlist
    {
        return $this->getAuthModel()
            ->playlists()
            ->watchlist();
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
