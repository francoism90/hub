<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\Models\Playlist;
use Illuminate\Support\Collection;

trait WithPlaylists
{
    public function bootWithPlaylists(): void
    {
        $this->authorize('viewAny', Playlist::class);
    }

    protected function playlistTypes(): Collection
    {
        return collect(PlaylistType::toValues());
    }

    protected function findPlaylistType(string $value): ?PlaylistType
    {
        return PlaylistType::tryFrom($value);
    }

    protected function findPlaylistModel(string $value): ?Playlist
    {
        return Playlist::findByPrefixedId($value);
    }
}
