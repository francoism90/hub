<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Models\Group;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class PopulateGroupDaily
{
    public function execute(Group $model, ?bool $force = null): void
    {
        DB::transaction(function () use ($model, $force) {
            if (! $force && $model->videos()->exists()) {
                return;
            }

            $model->attachVideos($this->getCollection()->collect(), detach: true);
        });
    }

    protected function getCollection(): LazyCollection
    {
        return Video::query()
            ->inRandomOrder()
            ->take($this->getLimit())
            ->cursor();
    }

    protected function getLimit(): int
    {
        return config('library.mixer.limit', 72);
    }
}
