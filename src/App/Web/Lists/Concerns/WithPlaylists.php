<?php

namespace App\Web\Lists\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;

trait WithPlaylists
{
    public function bootWithPlaylists(): void
    {
        $this->authorize('viewAny', Playlist::class);
    }

    protected static function getPlaylist(string $name, ?User $user = null): ?Playlist
    {
        $user ??= auth()->user();

        $playlist = Playlist::findByName($user, $name);

        if ($playlist) {
            $this->authorize('update', $playlist);
        }

        return $playlist;
    }
}
