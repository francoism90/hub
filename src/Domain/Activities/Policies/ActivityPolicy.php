<?php

declare(strict_types=1);

namespace Domain\Activities\Policies;

use Domain\Activities\Models\Activity;
use Domain\Users\Models\User;

class ActivityPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Activity $activity): bool
    {
        return $activity->user()->is($user) || $user->hasRole('super-admin');
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Activity $activity): bool
    {
        return $activity->user()->is($user) || $user->hasRole('super-admin');
    }

    public function delete(User $user, Activity $activity): bool
    {
        return $this->update($user, $activity);
    }

    public function restore(User $user, Activity $activity): bool
    {
        return $this->update($user, $activity);
    }

    public function forceDelete(User $user, Activity $activity): bool
    {
        return $user->hasRole('super-admin');
    }
}
