<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;

trait WithPlaylist
{
    public Playlist $playlist;

    public function bootWithPlaylist(): void
    {
        $this->authorize('view', $this->playlist);
    }

    public function onPlaylistDeleted(): void
    {
        abort(404);
    }

    public function onPlaylistUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    protected function getPlaylistId(): string
    {
        return $this->getPlaylist()->getRouteKey();
    }

    protected function getPlaylistListeners(): array
    {
        return [
            "echo-private:playlist.{$this->getPlaylistId()},.playlist.trashed" => 'onPlaylistDeleted',
            "echo-private:playlist.{$this->getPlaylistId()},.playlist.updated" => 'onPlaylistUpdated',
        ];
    }
}
