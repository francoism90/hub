<?php

namespace App\Web\Videos\Components;

use Domain\Playlists\Models\Playlist;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

class Watching extends Section
{
    #[Computed]
    public function items(): Collection
    {
        return $this->getPlaylist()->videos()
            ->published()
            ->orderByDesc('videoables.updated_at')
            ->take(16)
            ->get();
    }

    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    protected function getTitle(): ?string
    {
        return __('Continue Watching');
    }

    protected function getPlaylist(): Playlist
    {
        $playlist = Playlist::findByName(auth()->user(), 'history');

        $this->authorize('view', $playlist);

        return $playlist;
    }

    public function getListeners(): array
    {
        $id = static::getAuthKey();

        return [
            "echo-private:user.{$id},.playlist.deleted" => 'refresh',
            "echo-private:user.{$id},.playlist.updated" => 'refresh',
            "echo-private:user.{$id},.video.deleted" => 'refresh',
            "echo-private:user.{$id},.video.updated" => 'refresh',
        ];
    }
}
