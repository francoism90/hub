<?php

namespace App\Web\Auth\Concerns;

use Domain\Users\Models\User;

trait WithAuthentication
{
    public function bootWithAuthentication(): void
    {
        $this->authorize('update', $this->getUser());
    }

    public function onUserDeleted(): void
    {
        abort(404);
    }

    public function onUserUpdated(): void
    {
        $this->dispatch('$refresh');
    }

    protected function getUser(): User
    {
        return auth()->user();
    }

    protected function getUserId(): string
    {
        return $this->getUser()->getRouteKey();
    }

    protected function getAuthListeners(): array
    {
        return [
            "echo-private:user.{$this->getUserId()},.user.trashed" => 'onUserDeleted',
            "echo-private:user.{$this->getUserId()},.user.updated" => 'onUserUpdated',
        ];
    }
}
