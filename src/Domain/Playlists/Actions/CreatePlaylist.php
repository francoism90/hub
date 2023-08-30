<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Illuminate\Support\Arr;

class CreatePlaylist
{
    public function execute(User $user, array $attributes): Playlist
    {
        return $user->playlists()->firstOrCreate(
            Arr::only($attributes, ['name', 'type']),
            Arr::only($attributes, app(Playlist::class)->getFillable()),
        );
    }
}
