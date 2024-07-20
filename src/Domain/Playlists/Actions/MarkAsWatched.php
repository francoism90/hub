<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Jobs\MarkWatched;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class MarkAsWatched
{
    public function execute(User $user, Video $video, float $time = 0): void
    {
        throw_unless(! $time || ($time >= 0 && $time <= ceil($video->duration)));

        $key = $this->getWatchKey($video);

        // Store current time
        $user->storeSet($key, $time, now()->addMonths(3));

        // Persist to database
        $this->saveHistory($user, $video);
    }

    protected function getWatchKey(Video $video): string
    {
        return sprintf('watched:%s', $video->getKey());
    }

    protected function saveHistory(User $user, Video $video): void
    {
        MarkWatched::dispatch($user, $video)
            ->delay(now()->addSeconds(15));
    }
}
