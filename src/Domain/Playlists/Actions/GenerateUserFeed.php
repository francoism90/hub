<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Collection;

class GenerateUserFeed
{
    public function execute(User $user, ?bool $force = null): void
    {
        $model = $this->createPlaylist($user);

        $model->attachVideos($this->getAttachables());
    }

    protected function getAttachables(): Collection
    {
        return Video::query()
            ->inRandomOrder()
            ->take(12)
            ->get();
    }

    protected function createPlaylist(User $user): Playlist
    {
        $attributes = [
            'name' => 'daily',
            'type' => PlaylistType::Mixer,
        ];

        return app(CreateNewPlaylist::class)->execute($user, $attributes);
    }
}
