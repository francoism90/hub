<?php

namespace App\Web\Tags\Concerns;

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
        abort(404);
    }

    public function onTagUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function getTag(): Tag
    {
        return $this->tag;
    }

    protected function getTagId(): string
    {
        return $this->getTag()->getRouteKey();
    }

    protected function getTagListeners(): array
    {
        return [
            "echo-private:tag.{$this->getTagId()},.tag.deleted" => 'onTagDeleted',
            "echo-private:tag.{$this->getTagId()},.tag.updated" => 'onTagUpdated',
        ];
    }
}
