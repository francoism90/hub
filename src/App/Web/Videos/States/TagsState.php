<?php

namespace App\Web\Videos\States;

use Domain\Tags\Models\Tag;
use Foxws\LivewireUse\Views\Support\State;
use Illuminate\Support\Collection;

class TagsState extends State
{
    public $foo = 'bar';

    public function tags(): Collection
    {
        return Tag::query()
            ->ordered()
            ->get();
    }
}
