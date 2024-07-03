<?php

namespace App\Livewire\Tags\Concerns;

use Domain\Tags\Models\Tag;

trait WithTag
{
    public Tag $tag;

    public function bootWithTag(): void
    {
        $this->authorize('view', $this->tag);
    }

    public function onTagDeleted(): void
    {
        $this->dispatch('$refresh');
    }

    public function onTagUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function getTagId(): ?string
    {
        return $this->tag->getRouteKey();
    }

    protected function getTagListeners(): array
    {
        return [
            "echo-private:tag.{$this->getTagId()},.tag.deleted" => 'onTagDeleted',
            "echo-private:tag.{$this->getTagId()},.tag.updated" => 'onTagUpdated',
        ];
    }
}
