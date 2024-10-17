<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use ArrayAccess;
use Illuminate\Support\Arr;
use Domain\Groups\Models\Group;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class PopulateGroupTagged
{
    public function execute(Group $model, ?bool $force = null): void
    {
        DB::transaction(function () use ($model, $force) {
            if (! $force && $model->videos()->exists()) {
                return;
            }

            throw_if(! $tag = $model->options?->tag);

            $model->attachVideos($this->getCollection($model, $tag)->collect(), detach: true);
        });
    }

    protected function getCollection(Group $model, ArrayAccess|array|int $value): LazyCollection
    {
        return Video::query()
            ->withWhereHas('tags', fn (Builder $query) => $query->whereIn('id', Arr::wrap($value)))
            ->inRandomOrder()
            ->take($this->getLimit())
            ->cursor();
    }

    protected function getLimit(): int
    {
        return config('videos.mixer.limit', 32);
    }
}
