<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Models\Group;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class PopulateGroupDiscover
{
    public function execute(Group $model, ?bool $force = null): void
    {
        DB::transaction(function () use ($model, $force) {
            if (! $force && $model->videos()->exists()) {
                return;
            }

            $model->attachVideos($this->getCollection($model)->collect(), detach: true);
        });
    }

    protected function getCollection(Group $model): LazyCollection
    {
        return Video::query()
            ->whereDoesntHave('groups', fn (Builder $query) => $query
                ->where('groups.user_id', $model->user_id)
                ->where('groups.kind', GroupSet::Viewed)
            )
            ->published()
            ->inRandomOrder()
            ->take($this->getLimit())
            ->cursor();
    }

    protected function getLimit(): int
    {
        return config('videos.mixer.limit', 72);
    }
}
