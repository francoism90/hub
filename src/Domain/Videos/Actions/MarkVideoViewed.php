<?php

namespace Domain\Videos\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class MarkVideoViewed
{
    public function execute(User $user, Video $video): void
    {
        $model = $this->getModel($user);

        $model->attachVideo($video);
    }

    protected function getModel(User $user): Playlist
    {
        return $user
            ->playlists()
            ->system()
            ->history()
            ->firstOrFail();
    }
}
