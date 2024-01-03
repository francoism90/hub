<?php

namespace App\Web\Videos\States;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Views\Support\State;
use Illuminate\Support\Collection;

class TagState extends State
{
    public function tags(): Collection
    {
        return Tag::query()
            ->ordered()
            ->get();
    }

    public function tagTypes(): array
    {
        return TagType::toArray();
    }
}