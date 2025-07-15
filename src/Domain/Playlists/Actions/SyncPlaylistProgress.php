<?php

declare(strict_types=1);

namespace Domain\Playlists\Actions;

use Domain\Playlists\DataObjects\PlaylistProgressData;
use Domain\Playlists\Jobs\PlaylistProgress;
use Domain\Playlists\Models\Playlist;

class SyncPlaylistProgress
{
    public function handle(Playlist $playlist, ?float $percentage = null, ?float $remaining = null, ?float $rate = null): void
    {
        $job = config('playlist.jobs.sync_process', PlaylistProgress::class);

        app($job)->dispatch($playlist, PlaylistProgressData::from([
            'percentage' => $percentage,
            'remaining' => $remaining,
            'rate' => $rate,
        ]));
    }
}
