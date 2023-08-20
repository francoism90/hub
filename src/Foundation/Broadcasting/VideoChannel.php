<?php

namespace Foundation\Broadcasting;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class VideoChannel
{
    public function join(User $user, Video $model): bool
    {
        return true;
    }
}
