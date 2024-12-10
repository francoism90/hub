<?php

declare(strict_types=1);

namespace App\Web\Videos\Forms;

use Domain\Tags\Algos\GetPopularTags;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;

class TagsForm extends Form
{
    #[Validate('nullable|string|max:255')]
    public string $query = '';

    public function results(): Collection
    {
        $this->authorize('viewAny', Tag::class);

        if (! $query = $this->query()) {
            return $this->popular()->take(16);
        }

        return Tag::search($query)
            ->take(16)
            ->get();
    }

    public function query(): string
    {
        return str($this->get('query', ''))
            ->title()
            ->squish()
            ->value();
    }

    protected function popular(): Collection
    {
        $algo = GetPopularTags::make()->run();

        $keys = $algo->meta['items']->pluck('id');

        return Tag::query()
            ->whereIn('id', $keys)
            ->get()
            ->sortBy(fn (Tag $tag) => array_search($tag->getKey(), $keys->toArray()));
    }
}
