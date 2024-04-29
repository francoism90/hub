<?php

namespace App\Livewire\Forms\Concerns;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Validate;

trait WithTags
{
    #[Validate('nullable|array|min:1|max:50|exists:tags,prefixed_id')]
    public array $tags = [];

    #[Validate('nullable|string|min:1|max:100')]
    public string $tagQuery = '';

    public function getTags(): TagCollection
    {
        $this->authorize('viewAny', Tag::class);

        return TagCollection::make($this->tags)->toModels();
    }

    public function getTagsQuery(): TagCollection
    {
        $this->authorize('viewAny', Tag::class);

        return Tag::search($this->tagQuery)
            ->take(static::getTagsQueryLimit() ?? 5)
            ->get();
    }

    protected function fillModelTags(Model $model, string $relationship = 'tags'): void
    {
        $this->fill([
            'tags' => $model->{$relationship}?->routeKeys()->toArray() ?? []
        ]);
    }

    protected static function getTagsQueryLimit(): ?int
    {
        return null;
    }
}
