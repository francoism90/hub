<?php

namespace Domain\Playlists\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class SyncWatchHistory
{
    public function execute(User $user, Video $video, ?float $time = null): void
    {
        $time ??= app(GetVideoStartTime::class)->execute($user, $video);

        $model = $user->playlists()->history();

        // Attach the video to the playlist history
        $model->attachVideo($video, [
            'timestamp' => round($time ?? 0, 2),
        ]);

        // Touch parent to trigger broadcast
        $model->touch();
    }
}
