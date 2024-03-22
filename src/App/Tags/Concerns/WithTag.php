<?php

namespace App\Tags\Concerns;

use Domain\Tags\Models\Tag;
use Livewire\Attributes\Locked;

trait WithTag
{
    #[Locked]
    public Tag $tag;

    public function bootWithTag(): void
    {
        $this->authorize('view', $this->tag);
    }

    protected function getTagId(): string
    {
        return $this->tag->getRouteKey();
    }

    protected function refreshTag(): void
    {
        $this->tag->refresh();

        $this->dispatch("tag-updated.{$this->getTagId()}");
    }

    public function onTagDeleted(): void
    {
        $this->refreshTag();
    }

    public function onTagUpdated(): void
    {
        $this->refreshTag();
    }

    protected function getTagListeners(): array
    {
        return [
            "echo-private:tag.{$this->getTagId()},.tag.deleted" => 'onTagDeleted',
            "echo-private:tag.{$this->getTagId()},.tag.updated" => 'onTagUpdated',
        ];
    }
}
