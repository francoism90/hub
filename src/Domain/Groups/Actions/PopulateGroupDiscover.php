<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupCategory;
use Domain\Groups\Enums\GroupType;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class PopulateGroupDiscover
{
    public function execute(User $user, ?bool $force = null): void
    {
        DB::transaction(function () use ($user, $force) {
            $model = app(CreateNewGroup::class)->execute($user, [
                'name' => GroupCategory::Discover->value,
                'title' => GroupCategory::Discover->label(),
                'type' => GroupType::Mixer,
            ]);

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
