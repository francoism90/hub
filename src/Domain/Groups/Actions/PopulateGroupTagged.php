<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class PopulateGroupTagged
{
    public function execute(User $user, Tag $tag, ?bool $force = null): void
    {
        DB::transaction(function () use ($user, $tag, $force) {
            $model = app(CreateNewGroup::class)->execute($user, [
                'name' => $tag->name,
                'kind' => GroupSet::Tagged,
                'type' => GroupType::Mixer,
            ]);

            if (! $force && $model->videos()->exists()) {
                return;
            }

            $model->attachVideos($this->getCollection($user, $tag)->collect(), detach: true);
        });
    }

    protected function getCollection(User $user, Tag $tag): LazyCollection
    {
        return $tag
            ->videos()
            ->inRandomOrder()
            ->take($this->getLimit())
            ->cursor();
    }

    protected function getLimit(): int
    {
        return config('videos.mixer.limit', 72);
    }
}
