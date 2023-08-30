<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;

trait WithHistory
{
    public function bootWithHistory(): void
    {
        $this->authorize('view', $this->getHistory());
    }

    protected function getHistory(): Playlist
    {
        return $this->getUser()
            ->playlists()
            ->history()
            ->firstOrFail();
    }

    protected function isWatched(Video $video): bool
    {
        return $this
            ->getHistory()
            ->videos()
            ->where('id', $video->getKey())
            ->exists();
    }
}
