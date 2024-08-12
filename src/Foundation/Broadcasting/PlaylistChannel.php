<?php

namespace Foundation\Broadcasting;

use Domain\Playlists\Models\Playlist;
use Domain\Playlists\States\Verified;
use Domain\Users\Models\User;

class PlaylistChannel
{
    public function join(User $user, Playlist $model): bool
    {
        return $model->state->equals(Verified::class) ?? $user->hasRole('super-admin');
    }
}
