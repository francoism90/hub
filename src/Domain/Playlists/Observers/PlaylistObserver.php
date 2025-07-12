<?php

declare(strict_types=1);

namespace Domain\Playlists\Observers;

use Domain\Playlists\Models\Playlist;

class PlaylistObserver
{
    public function deleted(Playlist $playlist): void
    {
        if (method_exists($playlist, 'isForceDeleting') && ! $playlist->isForceDeleting()) {
            return;
        }

        if ($playlist->getFilesystem()->directoryExists($playlist->getPath())) {
            $playlist->getFilesystem()->deleteDirectory($playlist->getPath());
        }
    }
}
