<?php

namespace App\Web\Videos\Forms;

use Domain\Tags\Models\Tag;
use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

class TagsForm extends Form
{
    #[Validate('nullable|string|max:255')]
    public string $query = '';

    #[Computed]
    public function results(): Collection
    {
        $this->authorize('viewAny', Tag::class);

        if (! $query = $this->query()) {
            return $this->popular();
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
        return DB::table('taggables')
            ->selectRaw('prefixed_id, name, count(tag_id) as tagged_count')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tags.id')
            ->orderBy('tagged_count', 'desc')
            ->take(16)
            ->get()
            ->map(fn (\stdClass $item) => fluent([
                'prefixed_id' => $item->prefixed_id,
                'name' => json_decode($item->name)->en,
                'count' => $item->tagged_count,
            ]));
    }
}
