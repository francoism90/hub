<?php

namespace Foundation\Broadcasting;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;

class PlaylistChannel
{
    public function join(User $user, Playlist $model): bool
    {
        return $user->is($model) ?? $user->hasRole('super-admin');
    }
}
