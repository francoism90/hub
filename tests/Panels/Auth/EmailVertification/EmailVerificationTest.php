<?php

use Domain\Users\Models\User;
use Filament\Facades\Filament;

it('can verify an email', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    expect($user)
        ->hasVerifiedEmail()->toBeFalse();

    $this
        ->actingAs($user)
        ->get(Filament::getVerifyEmailUrl($user))
        ->assertRedirect(Filament::getUrl());

    expect($user->refresh())
        ->hasVerifiedEmail()->toBeTrue();
});
