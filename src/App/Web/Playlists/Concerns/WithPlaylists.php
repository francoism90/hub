<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Actions\CreateMixedPlaylists;
use Domain\Playlists\Enums\PlaylistMixer;
use Domain\Playlists\Models\Playlist;

trait WithPlaylists
{
    public function bootWithPlaylists(): void
    {
        $this->authorize('viewAny', Playlist::class);

        app(CreateMixedPlaylists::class)->execute(auth()->user());
    }

    protected function getMixers(): array
    {
        return PlaylistMixer::cases();
    }
}
