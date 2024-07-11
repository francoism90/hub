<?php

namespace Domain\Playlists\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class UpdatePlaylistHistory
{
    public function execute(User $user, Video $video, float $time = 0): void
    {
        $model = $user->playlists()->history();

        // Attach the video to the playlist history
        $model->attachVideo($video, [
            'timestamp' => round($time, 2),
        ]);

        // Touch parent to trigger broadcast
        $model->touch();
    }
}
