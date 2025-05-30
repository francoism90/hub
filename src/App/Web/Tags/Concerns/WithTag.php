<?php

declare(strict_types=1);

namespace App\Web\Tags\Concerns;

use Domain\Tags\Models\Tag;

trait WithTag
{
    public Tag $tag;

    public function bootWithTag(): void
    {
        $this->authorize('view', $this->getTag());
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

    protected function getTagKey(): int
    {
        return $this->getTag()->getKey();
    }

    protected function getTagListeners(): array
    {
        return [
            "echo-private:tag.{$this->getTagId()},.tag.trashed" => 'onTagDeleted',
            "echo-private:tag.{$this->getTagId()},.tag.updated" => 'onTagUpdated',
        ];
    }
}
