<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;

trait WithFavorites
{
    public function bootWithFavorites(): void
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
