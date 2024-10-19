<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Illuminate\Support\LazyCollection;

class GetUserSuggestions
{
    public function execute(?User $user = null): LazyCollection
    {
        return LazyCollection::make([
            ...$this->getUserMixers(),
            ...$this->getTagMixers(),
        ]);
    }

    protected function getUserMixers(): LazyCollection
    {
        $items = LazyCollection::make([
            GroupSet::All,
            GroupSet::Discover,
        ]);

        return $items->map(fn (GroupSet $item) => fluent([
            'key' => $item->value,
            'label' => $item->label(),
        ]));
    }

    protected function getTagMixers(): LazyCollection
    {
        $items = Tag::query()
            ->withWhereHas('videos')
            ->inRandomOrder()
            ->take(10)
            ->cursor();

        return $items->map(fn (Tag $item) => fluent([
            'key' => $item->getRouteKey(),
            'label' => $item->name,
        ]));
    }
}
