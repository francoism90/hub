<?php

namespace App\Web\Lists\Concerns;

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

    protected function getPlaylistId(): string
    {
        return $this->playlist->getRouteKey();
    }

    protected function getPlaylistListeners(): array
    {
        return [
            "echo-private:playlist.{$this->getPlaylistId()},.playlist.deleted" => 'onPlaylistDeleted',
            "echo-private:playlist.{$this->getPlaylistId()},.playlist.updated" => 'onPlaylistUpdated',
        ];
    }
}
