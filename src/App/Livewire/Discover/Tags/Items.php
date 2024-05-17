<?php

namespace App\Livewire\Discover\Tags;

use Domain\Tags\Models\Tag;
use Foxws\WireUse\Models\Concerns\WithQueryBuilder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;
    use WithQueryBuilder;

    public function render(): View
    {
        return view('tags.items');
    }

    #[Computed(cache: true, key: 'taggables', seconds: 7200)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->withCount('videos')
            ->ordered()
            ->get()
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
            ->groupBy(fn (Tag $item) => str($item->name)->upper()->substr(0, 1));
    }

    protected static function getModelClass(): ?string
    {
        return Tag::class;
    }
}
