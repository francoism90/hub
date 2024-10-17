<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\LazyCollection;

class CreateMixerGroups
{
    public function execute(User $user, ?bool $force = null): void
    {
        if (! $force && filled($user->storeValue('mixers'))) {
            return;
        }

        $items = $this->getCollection()->map(function (mixed $item) {
            if ($item instanceof Model) {
                return $item->getRouteKey();
            }

            return $item instanceof \BackedEnum ? $item->value : $item;
        });

        $user->storeSet('mixers', $items->all(), now()->addHour());
    }

    protected function getCollection(): LazyCollection
    {
        return LazyCollection::make([
            ...$this->getUserMixers(),
            ...$this->getTagMixers(),
        ]);
    }

    protected function getUserMixers(): LazyCollection
    {
        return LazyCollection::make([
            GroupSet::Daily,
            GroupSet::Discover,
        ]);
    }

    protected function getTagMixers(): LazyCollection
    {
        return Tag::query()
            ->whereHas('videos')
            ->inRandomOrder()
            ->take(5)
            ->cursor();
    }
}
