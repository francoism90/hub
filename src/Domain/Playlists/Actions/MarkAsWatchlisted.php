<?php

namespace Domain\Playlists\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class MarkAsWatchlisted
{
    public function execute(User $user, Video $video, ?bool $force = null): void
    {
        $model = $user->playlists()->watchlist();

        if ($force === true) {
            $model->attachVideo($video);

            return;
        }

        // Toggle favorite state
        $video->isWatchlistedBy($user)
            ? $model->detachVideo($video)
            : $model->attachVideo($video);
    }
}
