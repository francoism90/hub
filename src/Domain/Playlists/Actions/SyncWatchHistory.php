<?php

namespace Domain\Playlists\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class SyncWatchHistory
{
    public function execute(User $user, Video $video, ?float $time = null): void
    {
        DB::transaction(function () use ($user, $video, $time) {
            $time ??= $video->timeCodeFor($user);

            $model = $user->playlists()->history();

            // Attach the video to the playlist history
            $model->attachVideo($video, [
                'timestamp' => $time,
            ]);

            // Touch parent to trigger broadcast
            $model->touch();
        });
    }
}
