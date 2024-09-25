<?php

namespace App\Web\Tags\Forms;

use Domain\Tags\Models\Tag;
use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

class RelatedForm extends Form
{
    #[Validate('nullable|string|max:255')]
    public string $query = '';

    public function results(): Collection
    {
        $this->authorize('viewAny', Tag::class);

        if (! $query = $this->query()) {
            return $this->popular();
        }

        return Tag::search($query)
            ->take(24)
            ->get();
    }

    public function query(): string
    {
        return str($this->get('query', ''))
            ->title()
            ->squish()
            ->value();
    }

    #[Computed(cache: true, key: 'popular-tags')]
    public function popular(): Collection
    {
        return Tag::query()
            ->withCount('videos')
            ->orderByDesc('videos_count')
            ->take(24)
            ->get();
    }
}
