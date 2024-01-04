<?php

namespace App\Web\Videos\States;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Support\StateObjects\State;
use Illuminate\Support\LazyCollection;
use Livewire\Attributes\Computed;

class TagState extends State
{
    #[Computed(persist: true)]
    public function ordered(): LazyCollection
    {
        return Tag::query()
            ->ordered()
            ->cursor();
    }

    #[Computed(persist: true)]
    public function types(): array
    {
        return TagType::toArray();
    }
}
