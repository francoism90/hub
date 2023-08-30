<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;

trait WithFavorites
{
    public function bootWithFavorites(): void
    {
        $this->authorize('view', $this->getFavorites());
    }

    protected function getFavorites(): Playlist
    {
        return $this->getUser()
            ->playlists()
            ->favorites()
            ->firstOrFail();
    }

    protected function isFavorited(Video $video): bool
    {
        return $this
            ->getFavorites()
            ->videos()
            ->where('id', $video->getKey())
            ->exists();
    }
}
