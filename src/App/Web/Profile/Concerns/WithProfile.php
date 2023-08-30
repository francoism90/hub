<?php

namespace App\Web\Profile\Concerns;

use Domain\Users\Models\User;

trait WithProfile
{
    public function bootWithProfile(): void
    {
        $this->authorize('view', $this->getProfile());
    }

    protected function getProfile(): ?User
    {
        return auth()->user();
    }
}
