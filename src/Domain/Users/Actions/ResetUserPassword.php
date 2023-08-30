<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetUserPassword
{
    public function execute(User $user, array $attributes): void
    {
        $user->forceFill([
            'password' => Hash::make($attributes['password']),
        ])->saveOrFail();
    }
}
