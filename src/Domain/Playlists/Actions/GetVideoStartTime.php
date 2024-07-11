<?php

namespace Domain\Playlists\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class GetVideoStartTime
{
    public function execute(User $user, Video $video): float
    {
        $key = $this->getWatchKey($video);

        return $user->storeValue($key, 0);
    }

    protected function getWatchKey(Video $video): string
    {
        return sprintf('watched:%s', $video->getKey());
    }
}
