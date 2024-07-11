<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Jobs\MarkAsWatched;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class MarkWatched
{
    public function execute(User $user, Video $video, float $time = 0): void
    {
        throw_unless(! $time || ($time >= 0 && $time <= ceil($video->duration)));

        $key = $this->getWatchKey($video);

        // Store current time
        $user->storeSet($key, $time);

        // Persist to database
        $this->saveHistory($user, $video, $time);
    }

    protected function getWatchKey(Video $video): string
    {
        return sprintf('watched:%s', $video->getKey());
    }

    protected function saveHistory(User $user, Video $video, float $time): void
    {
        MarkAsWatched::dispatch($user, $video, $time)
            ->delay(now()->addSeconds(30));
    }
}
