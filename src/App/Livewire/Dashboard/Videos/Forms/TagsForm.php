<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class TagsForm extends Form
{
    #[Validate('nullable|string|max:100')]
    public string $query = '';

    public function query(): string
    {
        return str($this->get('query', ''))
            ->headline()
            ->squish()
            ->value();
    }

    public function results(): TagCollection
    {
        $this->authorize('viewAny', Tag::class);

        return Tag::search($this->query())
            ->take(5)
            ->get()
            ->options();
    }
}
