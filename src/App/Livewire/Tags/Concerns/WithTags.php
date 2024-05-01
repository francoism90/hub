<?php

namespace App\Livewire\Tags\Concerns;

use Domain\Tags\Collections\TagCollection;
use Domain\Tags\Models\Tag;

trait WithTags
{
    public ?Tag $tag = null;

    public function bootWithTags(): void
    {
        if ($this->tag instanceof Tag) {
            $this->authorize('view', $this->tag);
        }
    }

    public function getTagModels(array $ids = []): array
    {
        $this->authorize('viewAny', Tag::class);

        $collect = TagCollection::make($ids)->toModels();

        return $collect
            ->pluck('name', 'prefixed_id')
            ->toArray();
    }

    protected function getTagId(): ?string
    {
        return $this->tag->getRouteKey();
    }

    public function onTagDeleted(): void
    {
        //
    }

    public function onTagUpdated(): void
    {
        //
    }

    protected function getTagListeners(): array
    {
        return [
            "echo-private:tag.{$this->getTagId()},.tag.deleted" => 'onTagDeleted',
            "echo-private:tag.{$this->getTagId()},.tag.updated" => 'onTagUpdated',
        ];
    }
}
