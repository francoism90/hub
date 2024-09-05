<?php

namespace Domain\Users\Actions;

use Domain\Users\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateNewUser
{
    public function execute(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            $attributes['password'] = Hash::make(
                $attributes['password'] ?? Str::random()
            );

            $model = User::firstOrCreate([
                Arr::only($attributes, ['email']),
                Arr::only($attributes, app(User::class)->getFillable()),
            ]);

            app(RegenerateUser::class)->execute($model);
        });
    }
}
