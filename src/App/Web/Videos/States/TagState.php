<?php

namespace App\Web\Videos\States;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Support\StateObjects\State;
use Illuminate\Support\LazyCollection;

class TagState extends State
{
    public function ordered(?array $items = null): LazyCollection
    {
        $this->canViewAny(Tag::class);

        return Tag::query()
            ->ordered()
            ->cursor()
            ->when($items, fn (LazyCollection $collection) => $collection
                ->sortByDesc(fn (Tag $item) => in_array($item->getRouteKey(), $items))
            );
    }

    public function types(): array
    {
        return TagType::toArray();
    }
}
