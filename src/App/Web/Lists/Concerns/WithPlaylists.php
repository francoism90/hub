<?php

namespace App\Web\Lists\Concerns;

use Domain\Playlists\Models\Playlist;

trait WithPlaylists
{
    public function bootWithPlaylists(): void
    {
        $this->authorize('viewAny', Playlist::class);
    }
}
