<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Domain\Tags\Collections\TagCollection;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class TagsForm extends Form
{
    #[Validate('nullable|string|max:255')]
    public string $search = '';

    public function getSearch(): string
    {
        return str($this->get('search', ''))
            ->headline()
            ->squish()
            ->value();
    }

    public function getModels(array $ids = []): TagCollection
    {
        return TagCollection::make($ids)->toModels();
    }
}
