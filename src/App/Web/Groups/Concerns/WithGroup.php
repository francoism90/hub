<?php

declare(strict_types=1);

namespace App\Web\Groups\Concerns;

use Domain\Groups\Models\Group;

trait WithGroup
{
    public Group $group;

    public function bootWithGroup(): void
    {
        $this->authorize('view', $this->getGroup());
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
        return $this->group;
    }

    protected function getGroupId(): string
    {
        return $this->getGroup()->getRouteKey();
    }

    protected function getGroupListeners(): array
    {
        return [
            "echo-private:group.{$this->getGroupId()},.group.trashed" => 'onGroupDeleted',
            "echo-private:group.{$this->getGroupId()},.group.updated" => 'onGroupUpdated',
        ];
    }
}
