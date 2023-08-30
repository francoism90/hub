<?php

namespace App\Web\Profile\Concerns;

use Domain\Users\Models\User;

trait WithProfile
{
    public function bootWithAuthorization(): void
    {
        $this->authorize('view', $this->getProfile());
    }

    protected function getProfile(): ?User
    {
        return $this->video->getRouteKey();
    }
}
