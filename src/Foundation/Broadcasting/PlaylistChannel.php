<?php

namespace Foundation\Broadcasting;

use Domain\Groups\Models\Group;
use Domain\Groups\States\Verified;
use Domain\Users\Models\User;

class GroupChannel
{
    public function join(User $user, Group $model): bool
    {
        return $model->state->equals(Verified::class) ?? $user->hasRole('super-admin');
    }
}
