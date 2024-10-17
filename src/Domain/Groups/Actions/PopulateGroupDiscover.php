<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class PopulateGroupDiscover
{
    public function execute(User $user, ?bool $force = null): void
    {
        DB::transaction(function () use ($user, $force) {
            $model = app(CreateNewGroup::class)->execute($user, [
                'name' => GroupSet::Discover->label(),
                'kind' => GroupSet::Discover,
                'type' => GroupType::Mixer,
            ]);

            if (! $force && $model->videos()->exists()) {
                return;
            }

            $model->attachVideos($this->getCollection($user)->collect(), detach: true);
        });
    }

    protected function getCollection(User $user): LazyCollection
    {
        return Video::query()
            ->whereDoesntHave('groups', fn (Builder $query) => $query->where('groups.user_id', $user->getKey()))
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
