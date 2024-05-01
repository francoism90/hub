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

    public function getQuery(): string
    {
        return str($this->get('query', ''))
            ->headline()
            ->squish()
            ->value();
    }

    public function getResults(): array
    {
        $this->authorize('viewAny', Tag::class);

        return Tag::search($this->getQuery())
            ->get()
            ->pluck('name', 'prefixed_id')
            ->toArray();
    }

    public function getModels(array $ids = []): array
    {
        $this->authorize('viewAny', Tag::class);

        $collect = TagCollection::make($ids)->toModels();

        return $collect
            ->pluck('name', 'prefixed_id')
            ->toArray();
    }
}
