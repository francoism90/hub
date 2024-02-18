<?php

namespace App\Filament\Concerns;

use Domain\Users\Models\User;

trait InteractsWithAuthentication
{
    protected static function authUser(): ?User
    {
        return auth()->user();
    }

    protected static function hasRole(...$roles): bool
    {
        return static::authUser()->hasRole(...$roles);
    }

    protected static function hasAnyRole(...$roles): bool
    {
        return static::authUser()->hasAnyRole(...$roles);
    }

    protected static function isAdmin(): bool
    {
        return static::hasAnyRole('super-admin');
    }
}
