<?php

namespace Domain\Playlists\Policies;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;

class PlaylistPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Playlist $model): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, Playlist $model): bool
    {
        return $user->hasRole('super-admin');
    }

    public function delete(User $user, Playlist $model): bool
    {
        return $user->hasRole('super-admin');
    }

    public function restore(User $user, Playlist $model): bool
    {
        return $user->hasRole('super-admin');
    }

    public function forceDelete(User $user, Playlist $model): bool
    {
        return $user->hasRole('super-admin');
    }
}
