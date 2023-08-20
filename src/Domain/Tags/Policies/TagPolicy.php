<?php

namespace Domain\Tags\Policies;

use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;

class TagPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tag $model): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, Tag $model): bool
    {
        return $user->hasRole('super-admin');
    }

    public function delete(User $user, Tag $model): bool
    {
        return $user->hasRole('super-admin');
    }

    public function restore(User $user, Tag $model): bool
    {
        return $user->hasRole('super-admin');
    }

    public function forceDelete(User $user, Tag $model): bool
    {
        return $user->hasRole('super-admin');
    }
}
