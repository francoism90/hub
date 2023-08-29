<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

class CreateVideoHistory
{
    public function execute(User $user, Video $video): void
    {
        $model = $this->getModel($user);

        $model->attachVideo($video);
    }

    protected function getModel(User $user): Playlist
    {
        return $user->playlists()->firstOrCreate([
            'name' => 'history',
            'type' => PlaylistType::system()
        ]);
    }
}
