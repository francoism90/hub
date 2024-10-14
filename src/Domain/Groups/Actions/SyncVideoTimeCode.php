<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Jobs\MarkWatched;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Number;

class SyncVideoTimeCode
{
    public function execute(User $user, Video $video, ?float $time = null): void
    {
        // Get timestamp
        $value = Number::clamp($time ?? 0, 0, $video->duration);

        // Cache current time
        $user->storeSet($video->timecode, $value, now()->addMonth());

        // Persist to database
        MarkWatched::dispatch($user, $video)
            ->delay(now()->addSeconds(10));
    }
}
