<?php

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTags;
use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Views\Components\Page;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;

class TagIndexController extends Page
{
    use WithTags;

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
        return Tag::query()
            ->withCount('videos')
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Tag $tag) => str($tag->name)->upper()->substr(0, 1));
    }
}
