<?php

namespace App\Admin\Concerns;

use Domain\Users\Models\User;

trait InteractsWithAuthentication
{
    protected static function hasRole(...$roles): bool
    {
        /** @var User */
        $user = auth()->user();

        return $user->hasRole(...$roles);
    }
}
