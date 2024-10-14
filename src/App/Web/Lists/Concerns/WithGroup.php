<?php

declare(strict_types=1);

namespace App\Web\Lists\Concerns;

use Domain\Groups\Models\Group;

trait WithGroup
{
    public Group $playlist;

    public function bootWithGroup(): void
    {
        $this->authorize('view', $this->playlist);
    }

    public function onGroupDeleted(): void
    {
        abort(404);
    }

    public function onGroupUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function getGroup(): ?Group
    {
        return $this->playlist;
    }

    protected function getGroupId(): string
    {
        return $this->getGroup()->getRouteKey();
    }

    protected function getGroupListeners(): array
    {
        return [
            "echo-private:playlist.{$this->getGroupId()},.playlist.trashed" => 'onGroupDeleted',
            "echo-private:playlist.{$this->getGroupId()},.playlist.updated" => 'onGroupUpdated',
        ];
    }
}
