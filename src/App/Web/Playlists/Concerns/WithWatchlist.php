<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;

trait WithWatchlist
{
    public function bootWithWatchlist(): void
    {
        $this->authorize('view', $this->getWatchlist());
    }

    protected function getWatchlist(): Playlist
    {
        return $this->getUser()
            ->playlists()
            ->watchlist()
            ->firstOrFail();
    }

    protected function isWatchlisted(Video $video): bool
    {
        return $this
            ->getWatchlist()
            ->videos()
            ->where('id', $video->getKey())
            ->exists();
    }

    protected function onWatchlisted(): void
    {
        $this->emit('refresh');
    }

    protected function getWatchlistListeners(): array
    {
        return [
            "echo-private:user.{$this->getUserId()},watchlisted" => 'onWatchlisted',
        ];
    }
}
