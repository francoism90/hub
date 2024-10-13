<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class PopulateMixerPlaylist
{
    public function execute(Playlist $model, int $limit = 48): void
    {
        DB::transaction(function () use ($model, $limit) {
            // TODO: check limit

            switch ($model->name) {
                case 'daily':
                    $model->attachVideos(Video::query()->daily()->pluck('id'));
                    break;
                case 'discover':
                    $model->attachVideos(Video::query()->daily()->pluck('id'));
                    break;
            }
        });
    }
}
