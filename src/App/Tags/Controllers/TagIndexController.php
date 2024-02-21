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

    public function mount(): void
    {
        $this->seo()->setTitle(__('Tags'));
    }

    public function render(): View
    {
        return view('tags.index');
    }

    #[Computed(cache: true, key: 'tags', seconds: 60 * 10)]
    public function items(): Collection
    {
        return $this->getQuery()
            ->withCount('videos')
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Tag $tag) => str($tag->name)->upper()->substr(0, 1));
    }

    protected static function getModelClass(): ?string
    {
        return Tag::class;
    }
}
