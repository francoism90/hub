<?php

namespace App\Web\Profile\Concerns;

use Domain\Users\Models\User;

trait WithAuthentication
{
    public function bootWithAuthentication(): void
    {
        $this->authorize('view', $this->getUser());
    }

    protected function getUser(): ?User
    {
        return auth()->user();
    }

    protected function getUserId(): ?string
    {
        return $this->getUser()?->getRouteKey();
    }
}
