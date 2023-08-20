<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Rules\Password;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $attributes): User
    {
        Validator::make($attributes, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->validate();

        // Hash password
        $attributes['password'] = Hash::make($attributes['password']);

        return User::firstOrCreate([
            Arr::only($attributes, ['email']),
            Arr::only($attributes, app(User::class)->getFillable()),
        ]);
    }
}
