<?php

namespace App\Tags\Controllers;

use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Models\Concerns\WithQueryBuilder;
use Foxws\LivewireUse\Views\Components\Page;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class TagIndexController extends Page
{
    use WithQueryBuilder;

    public function render(): View
    {
        return view('tags.index');
    }

    public function getTitle(): string
    {
        return __('Tags');
    }

    #[Computed(cache: true, key: 'taggables', seconds: 7200)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->withCount('videos')
            ->ordered()
            ->get()
            ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
            ->groupBy(fn (Tag $tag) => str($tag->name)->upper()->substr(0, 1));
    }

    protected static function getModelClass(): ?string
    {
        return Tag::class;
    }
}
