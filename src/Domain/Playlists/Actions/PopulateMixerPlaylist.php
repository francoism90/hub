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

            if ($model->videos()->count() > $this->getLimit()) {
                $model->videos()->detach();
            }

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

    protected function getLimit(): int
    {
        return config('library.mixer.limit', 48);
    }
}
