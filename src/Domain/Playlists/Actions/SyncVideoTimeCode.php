<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Jobs\MarkWatched;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Number;

class SyncVideoTimeCode
{
    public function execute(User $user, Video $video, float $time = 0): void
    {
        // Get timestamp
        $value = round(Number::clamp($time, 0, $video->duration), 2);

        // Cache current time
        $user->storeSet($video->timecode, $value, now()->addMonth());

        // Persist to database
        MarkWatched::dispatch($user, $video)
            ->delay(now()->addSeconds(10));
    }
}
