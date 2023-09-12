<?php

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTags;
use Artesaos\SEOTools\Facades\SEOMeta;
use Domain\Tags\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TagIndexController extends Component
{
    use WithTags;

    public function mount(): void
    {
        SEOMeta::setTitle(__('Tags'));
    }

    public function render(): View
    {
        return view('tags::index');
    }

    #[Computed]
    public function items(): Collection
    {
        return Tag::query()
            ->withCount('videos')
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Tag $tag) => str($tag->name)->upper()->substr(0, 1));
    }
}
