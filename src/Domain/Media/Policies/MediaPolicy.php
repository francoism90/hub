<?php

namespace Domain\Media\Policies;

use Domain\Media\Models\Media;
use Domain\Users\Models\User;
use Illuminate\Auth\Access\Response;

class MediaPolicy
{
    public function viewAny(User $user): Response|bool
    {
        return $user->hasRole('super-admin');
    }

    public function view(User $user, Media $model): Response|bool
    {
        return true;
    }

    public function create(User $user): Response|bool
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, Media $model): Response|bool
    {
        return $user->hasRole('super-admin');
    }

    public function delete(User $user, Media $model): Response|bool
    {
        return $user->hasRole('super-admin');
    }

    public function restore(User $user, Media $model): Response|bool
    {
        return $user->hasRole('super-admin');
    }

    public function forceDelete(User $user, Media $model): Response|bool
    {
        return $user->hasRole('super-admin');
    }
}
