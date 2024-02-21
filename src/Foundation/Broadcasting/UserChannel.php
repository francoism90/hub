<?php

namespace Foundation\Broadcasting;

use Domain\Users\Models\User;

class UserChannel
{
    public function join(User $user, User $model): bool
    {
        return $user->is($model) ?? $user->hasRole('super-admin');
    }
}
