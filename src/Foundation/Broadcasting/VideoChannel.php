<?php

declare(strict_types=1);

namespace Foundation\Broadcasting;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;

class VideoChannel
{
    public function join(User $user, Video $model): bool
    {
        return $model->state->equals(Verified::class) ?? $user->hasRole('super-admin');
    }
}
