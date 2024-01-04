<?php

namespace App\Web\Videos\States;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Support\StateObjects\State;
use Illuminate\Support\Collection;

class TagState extends State
{
    public function ordered(): Collection
    {
        return Tag::query()
            ->ordered()
            ->get();
    }

    public function types(): array
    {
        return TagType::toArray();
    }
}
