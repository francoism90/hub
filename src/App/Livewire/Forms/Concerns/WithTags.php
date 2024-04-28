<?php

namespace App\Livewire\Forms\Concerns;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Builder;
use Livewire\Attributes\Validate;

trait WithTags
{
    #[Validate('nullable|array|min:1|max:50|exists:tags,prefixed_id')]
    public array $tags = [];

    public function getTags(): TagCollection
    {
        $this->authorize('viewAny', Tag::class);

        return TagCollection::make($this->tags)->toModels();
    }

    public function filterTags(string $value = '*'): Builder
    {
        $this->authorize('viewAny', Tag::class);

        return Tag::search($value);
    }

    protected function fillModelTags(Model $model): void
    {
        $this->fill([
            'tags' => $model->tags?->pluck('prefixed_id')->toArray() ?? []
        ]);
    }
}
