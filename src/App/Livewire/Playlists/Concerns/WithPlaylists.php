<?php

namespace App\Livewire\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;

trait WithPlaylists
{
    public ?Playlist $playlist = null;

    public function bootWithPlaylists(): void
    {
        if ($this->playlist instanceof Playlist) {
            $this->authorize('view', $this->playlist);
        }
    }

    public function onPlaylistDeleted(): void
    {
        //
    }

    public function onPlaylistUpdated(): void
    {
        //
    }

    protected function getPlaylistId(): ?string
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
