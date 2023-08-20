<?php

namespace Database\Seeders;

use Domain\Users\Models\User;
use Domain\Users\States\Verified;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $model = User::firstOrCreate(
            ['email' => 'administrator@example.com'],
            ['name' => 'Administrator', 'password' => Hash::make('password')]
        );

        $model->assignRole('super-admin');

        if ($model->state->canTransitionTo(Verified::class)) {
            $model->state->transitionTo(Verified::class);
        }
    }
}
