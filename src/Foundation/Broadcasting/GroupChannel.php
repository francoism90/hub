<?php

declare(strict_types=1);

namespace Foundation\Broadcasting;

use Domain\Groups\Models\Group;
use Domain\Groups\States\Verified;
use Domain\Users\Models\User;

class GroupChannel
{
    public function join(User $user, Group $model): bool
    {
        return $model->state->equals(Verified::class) ?? $model->user()->is($user) ?? $user->hasRole('super-admin');
    }
}
