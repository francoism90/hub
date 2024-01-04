<?php

namespace App\Web\Videos\Components;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Views\Components\Component;
use Illuminate\Support\LazyCollection;
use Illuminate\View\View;

class Filters extends Component
{
    public function render(): View
    {
        return view('videos.filters');
    }

    public function ordered(?array $items = null): LazyCollection
    {
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
