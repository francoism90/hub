<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
use Illuminate\Support\Facades\DB;

class PopulateMixerPlaylist
{
    public function execute(Playlist $model, ?bool $force = null): void
    {
        DB::transaction(function () use ($model, $force) {
            if (! $force && $model->videos()->exists()) {
                return;
            }

            switch ($model->name) {
                case 'daily':
                    $this->populateDaily($model);
                    break;
            }

            // Trigger broadcast
            $model->touch();
        });
    }

    protected function populateDaily(Playlist $model): void
    {
        $model->attachVideos(
            $this->getBuilder()->recommended()->get()
        );
    }

    protected function getBuilder(): VideoQueryBuilder
    {
        return Video::query()
            ->published();
    }
}
