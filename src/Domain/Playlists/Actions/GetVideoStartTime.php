<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class GetVideoStartTime
{
    public function execute(User $user, Video $video): ?float
    {
        $model = $this->getPlaylist($user)?->videos()->find($video);

        return data_get($model?->pivot?->options ?: [], 'timestamp', 0);
    }

    protected function getPlaylist(User $user): ?Playlist
    {
        return $user->playlists()->history();
    }
}
