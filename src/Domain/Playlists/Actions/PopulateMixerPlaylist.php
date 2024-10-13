<?php

namespace Domain\Playlists\Actions;

use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Domain\Videos\Models\Videoable;
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

            $this->syncVideoables($model);
        });
    }

    protected function populateDaily(Playlist $model): void
    {
        $items = $this->getBuilder()
            ->recommended()
            ->get();

        Videoable::withoutSyncingToSearch(function () use ($model, $items) {
            $model->attachVideos($items, detaching: true);
        });
    }

    protected function syncVideoables(Playlist $model): void
    {
        Videoable::query()
            ->where('videoable_type', $model->getMorphClass())
            ->where('videoable_id', $model->getKey())
            ->each(fn (Videoable $videoable) => $videoable->searchable());
    }

    protected function getBuilder(): VideoQueryBuilder
    {
        return Video::query()
            ->published();
    }
}
