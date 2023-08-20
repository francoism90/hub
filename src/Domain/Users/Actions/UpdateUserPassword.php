<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Rules\Password;

class UpdateUserPassword implements UpdatesUserPasswords
{
    public function update(User $user, array $attributes): void
    {
        Validator::make($attributes,
            [
                'current_password' => ['required', 'string', 'current_password:web'],
                'password' => ['required', 'string', new Password, 'confirmed'],
            ],
            [
                'current_password.current_password' => __('The provided password does not match your current password.'),
            ]
        )->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($attributes['password']),
        ])->saveOrFail();
    }
}
