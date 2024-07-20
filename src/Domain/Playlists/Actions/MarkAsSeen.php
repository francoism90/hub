<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Jobs\MarkWatched;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class MarkAsSeen
{
    public function execute(User $user, Video $video): void
    {
        MarkWatched::dispatch($user, $video);
    }
}
