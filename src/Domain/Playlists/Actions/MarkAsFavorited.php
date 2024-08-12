<?php

namespace Domain\Playlists\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class MarkAsFavorited
{
    public function execute(User $user, Video $video, ?bool $force = null): void
    {
        $model = $user->playlists()->favorites();

        if ($force === true) {
            $model->attachVideo($video);

            return;
        }

        // Toggle favorite state
        $video->isFavoritedBy($user)
            ? $model->detachVideo($video)
            : $model->attachVideo($video);

        // Touch parent to trigger broadcast
        $model->touch();
    }
}
