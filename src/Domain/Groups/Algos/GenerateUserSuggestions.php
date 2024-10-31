<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Foxws\Algos\Algos\Algo;
use Foxws\Algos\Algos\Result;
use Illuminate\Support\LazyCollection;

class GetUserSuggestions extends Algo
{
    public function handle(?User $user = null): Result
    {
        $items = collect([
            ...$this->getUserMixers(),
            ...$this->getTagMixers(),
        ]);

        return $this->success()
            ->with('items', $items);
    }

    protected function getUserMixers(): LazyCollection
    {
        $items = LazyCollection::make([
            GroupSet::All,
            GroupSet::Discover,
            GroupSet::Newest,
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
            ->take(14)
            ->cursor();

        return $items->map(fn (Tag $item) => fluent([
            'key' => $item->getRouteKey(),
            'label' => $item->name,
        ]));
    }
}
