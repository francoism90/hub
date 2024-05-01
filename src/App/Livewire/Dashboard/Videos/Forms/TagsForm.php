<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Domain\Tags\Collections\TagCollection;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class TagsForm extends Form
{
    #[Validate('nullable|string|max:1')]
    public string $query = '';

    public function getSearch(): string
    {
        return str($this->get('query', ''))
            ->headline()
            ->squish()
            ->value();
    }

    public function getModels(array $ids = []): array
    {
        $collect = TagCollection::make($ids)->toModels();

        return $collect
            ->pluck('name', 'prefixed_id')
            ->toArray();
    }
}
