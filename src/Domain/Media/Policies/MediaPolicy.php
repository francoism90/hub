<?php

declare(strict_types=1);

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
        if (in_array($media->collection_name, ['avatar', 'placeholder', 'thumbnail'])) {
            return true;
        }

        return $user?->hasRole('super-admin');
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
