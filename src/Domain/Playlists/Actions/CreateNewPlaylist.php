<?php

declare(strict_types=1);

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Illuminate\Database\Eloquent\Model;

class CreateNewPlaylist
{
    public function handle(Model $model, array $attributes = []): Playlist
    {
        return $model->playlists()->create(...[
            'file_name' => 'index.m3u8',
            'disk' => Playlist::getDestinationDisk(),
            'secret_disk' => Playlist::getSecretDisk(),
            'expires_at' => Playlist::getExpiresAfter(),
        ], ...$attributes);
    }
}
