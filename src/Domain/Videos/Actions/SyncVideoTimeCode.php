<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Activities\Jobs\ProcessViewed;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class SyncVideoTimeCode
{
    public function execute(User $user, Video $video, ?array $options = null): void
    {
        if ($timeCode = data_get($options, 'time')) {
            $user->storeSet($video->timecode, $timeCode, now()->addMonth());
        }

        ProcessViewed::dispatch($user, $video, $options);
    }
}
