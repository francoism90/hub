<?php

namespace Domain\Media\Policies;

use Domain\Media\Models\Media;
use Domain\Users\Models\User;

class MediaPolicy
{
    public function viewAny(?User $user): bool
    {
        return $user->hasRole('super-admin');
    }

    public function view(?User $user, Media $media): bool
    {
        if ($user && $user->hasRole('super-admin')) {
            return true;
        }

        return in_array($media->collection_name, [
            'avatar',
            'placeholder',
            'thumbnail',
        ]);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin');
    }

    public function delete(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin');
    }

    public function restore(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin');
    }

    public function forceDelete(User $user, Media $media): bool
    {
        return $user->hasRole('super-admin');
    }
}
