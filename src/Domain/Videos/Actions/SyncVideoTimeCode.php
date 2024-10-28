<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Domain\Videos\DataObjects\VideoableData;
use Domain\Videos\Jobs\StoreVideo;
use Domain\Videos\Models\Video;

class SyncVideoTimeCode
{
    public function execute(User $user, Video $video, ?VideoableData $data = null): void
    {
        if ($timeCode = $data?->time) {
            $video->modelCache('timecode', $timeCode, now()->addMonth());
        }

        StoreVideo::dispatch($user, $video, $data);
    }
}
