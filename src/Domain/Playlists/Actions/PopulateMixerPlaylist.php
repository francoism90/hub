<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class PopulateMixerPlaylist
{
    public function execute(Playlist $model, ?bool $force = null): void
    {
        DB::transaction(function () use ($model, $force) {
            if (! $force && $model->videos()->exists()) {
                return;
            }

            $builder = Video::query()
                ->published()
                ->take(48);

            switch ($model->name) {
                case 'daily':
                    $model->attachVideos($builder->daily()->pluck('id'));
                    break;
                case 'discover':
                    $model->attachVideos($builder->daily()->pluck('id'));
                    break;
            }
        });
    }
}
