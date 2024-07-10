<?php

namespace App\Web\Lists\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;

trait WithFavorites
{
    public function bootWithFavorites(): void
    {
        $this->authorize('view', static::favorites());
    }

    protected static function favorites(?User $user = null): Playlist
    {
        /** @var User */
        $user ??= auth()->user();

        return $user
            ->playlists()
            ->favorites()
            ->firstOrFail();
    }

    protected static function isFavorited(Video $video, ?User $user = null): bool
    {
        return static::favorites($user)
            ->videos()
            ->where('id', $video->getKey())
            ->exists();
    }
}
