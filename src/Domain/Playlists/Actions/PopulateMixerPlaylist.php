<?php

namespace Domain\Playlists\Actions;

use ArrayAccess;
use Domain\Playlists\Models\Playlist;
use Domain\Videos\Models\Video;
use Domain\Videos\Models\Videoable;
use Domain\Videos\QueryBuilders\VideoQueryBuilder;
use Illuminate\Support\Collection;
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
                    $this->attachVideos($model, $this->getBuilder()->daily()->pluck('id'));
                    break;
                case 'discover':
                    $this->attachVideos($model, $this->getBuilder()->daily()->pluck('id'));
                    break;
            }
        });
    }

    protected function attachVideos(Playlist $model, array|ArrayAccess|Collection $items): void
    {
        Videoable::withoutSyncingToSearch(function () use ($model, $items) {
            $model->attachVideos($items);
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
            ->published()
            ->take(48);
    }
}
