<?php

namespace App\Admin\Concerns;

use Domain\Users\Models\User;

trait InteractsWithAuthentication
{
    public static function hasRole(...$roles): bool
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->hasRole(...$roles);
    }
}
