<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class SyncWatchHistory
{
    public function execute(User $user, Video $video, ?float $time = null): void
    {


    }
}
