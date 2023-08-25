<?php

namespace App\Web\Videos\Components;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Filters extends Component
{
    public function render(): View
    {
        return view('videos::filters');
    }

    #[Computed]
    public function tags(): TagCollection
    {
        return Tag::all();
    }
}
