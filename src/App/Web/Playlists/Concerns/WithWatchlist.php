<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

trait WithWatchlist
{
    public function bootWithWatchlist(): void
    {
        $this->authorize('view', static::watchlist());
    }

    protected static function watchlist(?User $user = null): Playlist
    {
        /** @var User */
        $user ??= auth()->user();

        return $user
            ->playlists()
            ->watchlist()
            ->firstOrFail();
    }

    protected static function isWatchlisted(Video $video, ?User $user = null): bool
    {
        return static::watchlist($user)
            ->videos()
            ->where('id', $video->getKey())
            ->exists();
    }
}
