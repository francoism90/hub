<?php

namespace App\Profile\Concerns;

use Domain\Users\Models\User;

trait WithAuthentication
{
    public function bootWithAuthentication(): void
    {
        $this->authorize('view', static::user());
    }

    protected static function user(): ?User
    {
        return auth()->user();
    }

    protected static function userId(): ?string
    {
        return static::user()?->getRouteKey();
    }
}
