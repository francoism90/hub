<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateNewUser
{
    public function executue(array $attributes): User
    {
        $attributes['password'] = Hash::make($attributes['password'] ?? Str::random());

        return User::firstOrCreate([
            Arr::only($attributes, ['email']),
            Arr::only($attributes, app(User::class)->getFillable()),
        ]);
    }
}
