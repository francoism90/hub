<?php

namespace App\Web\Videos\States;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Support\StateObjects\State;
use Illuminate\Support\LazyCollection;

class TagState extends State
{
    public function ordered(): LazyCollection
    {
        return Tag::query()
            ->ordered()
            ->cursor();
    }

    public function types(): array
    {
        return TagType::toArray();
    }
}
