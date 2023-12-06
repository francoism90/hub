<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

trait WithHistory
{
    public function bootWithHistory(): void
    {
        $this->authorize('view', static::history());
    }

    protected static function history(?User $user = null): Playlist
    {
        /** @var User */
        $user ??= auth()->user();

        return $user
            ->playlists()
            ->history()
            ->firstOrFail();
    }

    protected static function isWatched(Video $video, ?User $user = null): bool
    {
        return static::history($user)
            ->videos()
            ->where('id', $video->getKey())
            ->exists();
    }
}
