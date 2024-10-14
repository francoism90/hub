<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkAsWatchlisted
{
    public function execute(User $user, Video $video, ?bool $force = null): void
    {
        DB::transaction(function () use ($user, $video, $force) {
            $model = $user->groups()->watchlist();

            // Toggle favorite state
            $force === true || ! $video->isWatchlistedBy($user)
                ? $model->attachVideo($video)
                : $model->detachVideo($video);

            // Touch parent to trigger broadcast
            $model->touch();
        });
    }
}
