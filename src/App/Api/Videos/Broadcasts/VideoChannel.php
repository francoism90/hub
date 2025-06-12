<?php

declare(strict_types=1);

namespace App\Api\Videos\Broadcasts;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Domain\Videos\States\Verified;

class VideoChannel
{
    public function join(User $user, Video $model): bool
    {
        return $model->state->equals(Verified::class) ?? $model->user()->is($user) ?? $user->hasRole('super-admin');
    }
}
