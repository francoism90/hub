<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Laravel\Fortify\Rules\Password;

class ResetUserPassword implements ResetsUserPasswords
{
    public function reset(User $user, array $attributes): void
    {
        Validator::make($attributes, [
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($attributes['password']),
        ])->saveOrFail();
    }
}
