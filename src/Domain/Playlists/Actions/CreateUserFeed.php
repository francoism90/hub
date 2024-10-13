<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Enums\PlaylistType;
use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Collection;

class CreateUserFeed
{
    public function execute(User $user, ?bool $force = null): void
    {
        $model = $this->createPlaylist($user);

        // if ($model->videos()->count() && true !== $force) {
        //     return;
        // }

        // Detach all videos from the playlist
        $model->videos()->detach();

        // Attach the latest videos to the playlist
        $model->attachVideos(
            $this->getVideoables()
        );
    }

    protected function getVideoables(): Collection
    {
        return Video::query()
            ->inRandomOrder()
            ->take(24 * 6)
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
