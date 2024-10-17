<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class CreateMixerGroups
{
    public function execute(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->createUserMixers($user);
            $this->createTagMixers($user);
        });
    }

    protected function createUserMixers(User $user): void
    {
        app(PopulateGroupDaily::class)->execute($user);

        app(PopulateGroupDiscover::class)->execute($user);
    }

    protected function createTagMixers(User $user): void
    {
        $this->getTagMixers()->each(
            fn (Tag $tag) => app(CreateNewGroup::class)->execute($user, [
                'name' => $tag->name,
                'kind' => GroupSet::Recommended,
                'type' => GroupType::Mixer,
                'options' => ['tag' => $tag->getKey()],
            ])
        );
    }

    protected function getTagMixers(): LazyCollection
    {
        return Tag::query()
            ->whereHas('videos')
            ->inRandomOrder()
            ->take($this->getLimit())
            ->cursor();
    }

    protected function getLimit(): int
    {
        return config('videos.mixer.dynamic', 5);
    }
}
