<?php

declare(strict_types=1);

namespace Domain\Playlists\Actions;

use Domain\Playlists\DataObjects\PlaylistProgressData;
use Domain\Playlists\Models\Playlist;
use Illuminate\Support\Facades\DB;

class UpdatePlaylistProgress
{
    public function handle(Playlist $playlist, PlaylistProgressData $progress): mixed
    {
        return DB::transaction(function () use ($playlist, $progress) {
            $playlist->updateOrFail(['progress' => $progress]);

            return $playlist;
        });

    }
}
