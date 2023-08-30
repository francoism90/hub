<?php

namespace App\Web\Playlists\Concerns;

use Domain\Playlists\Models\Playlist;

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

    protected function onFavorited(): void
    {
        $this->emit('refresh');
    }

    protected function getFavoritesListeners(): array
    {
        return [
            "echo-private:user.{$this->getUserId()},favorited" => 'onFavorited',
        ];
    }
}
