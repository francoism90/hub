<?php

declare(strict_types=1);

namespace Domain\Videos\Algos;

use Domain\Groups\Enums\GroupSet;
use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;
use Foxws\Algos\Algos\Algo;
use Foxws\Algos\Algos\Result;
use Illuminate\Support\LazyCollection;

class GenerateUserSuggestions extends Algo
{
    public function __construct(
        protected ?User $user = null,
        protected ?int $limit = null,
    ) {}

    public function handle(): Result
    {
        $items = collect([
            ...$this->getUserMixers(),
            ...$this->getTagMixers(),
        ]);

        return $this
            ->success()
            ->with('items', $items);
    }

    public function model(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function limit(int $value): static
    {
        $this->limit = $value;

        return $this;
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
