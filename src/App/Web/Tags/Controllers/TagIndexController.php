<?php

namespace App\Web\Tags\Controllers;

use App\Web\Tags\Concerns\WithTags;
use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TagIndexController extends Component
{
    use WithTags;

    public function render(): View
    {
        return view('tags::index');
    }


    #[Computed()]
    public function items(): TagCollection
    {
        return Tag::all();
    }
}
