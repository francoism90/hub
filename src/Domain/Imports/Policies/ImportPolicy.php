<?php

namespace Domain\Imports\Policies;

use Domain\Imports\Models\Import;
use Domain\Users\Models\User;

class ImportPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('super-admin');
    }

    public function view(User $user, Import $model): bool
    {
        return $model->user()->is($user) || $user->hasRole('super-admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('super-admin');
    }

    public function update(User $user, Import $model): bool
    {
        return $model->user()->is($user) || $user->hasRole('super-admin');
    }

    public function delete(User $user, Import $model): bool
    {
        return $model->user()->is($user) || $user->hasRole('super-admin');
    }

    public function restore(User $user, Import $model): bool
    {
        return $model->user()->is($user) || $user->hasRole('super-admin');
    }

    public function forceDelete(User $user, Import $model): bool
    {
        return $user->hasRole('super-admin');
    }
}
