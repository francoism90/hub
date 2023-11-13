<?php

use Domain\Users\Models\User;
use Filament\Facades\Filament;
use Filament\Notifications\Auth\ResetPassword;
use Filament\Pages\Auth\PasswordReset\RequestPasswordReset;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

it('can render page', function () {
    $this->get(Filament::getRequestPasswordResetUrl())
        ->assertSuccessful();
});

it('can request password reset', function () {
    $this->assertGuest();

    $user = User::factory()->create();

    Livewire::test(RequestPasswordReset::class)
        ->fillForm([
            'email' => $user->email,
        ])
        ->call('request')
        ->assertNotified();

    Notification::assertSentTo($user, ResetPassword::class);
});

it('can throttle requests', function () {
    $this->assertGuest();

    foreach (range(1, 2) as $i) {
        $user = User::factory()->create();

        Livewire::test(RequestPasswordReset::class)
            ->fillForm([
                'email' => $user->email,
            ])
            ->call('request')
            ->assertNotified();

        Notification::assertSentToTimes($user, ResetPassword::class, times: 1);
    }

    $user = User::factory()->create();

    Livewire::test(RequestPasswordReset::class)
        ->fillForm([
            'email' => $user->email,
        ])
        ->call('request')
        ->assertNotified();

    Notification::assertNotSentTo($user, ResetPassword::class);
});

it('can validate `email` is required', function () {
    Livewire::test(RequestPasswordReset::class)
        ->fillForm([
            'email' => '',
        ])
        ->call('request')
        ->assertHasFormErrors(['email' => ['required']]);
});

it('can validate `email` is valid email', function () {
    Livewire::test(RequestPasswordReset::class)
        ->fillForm([
            'email' => 'invalid-email',
        ])
        ->call('request')
        ->assertHasFormErrors(['email' => ['email']]);
});
