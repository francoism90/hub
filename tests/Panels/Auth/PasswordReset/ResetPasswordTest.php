<?php

use Domain\Users\Models\User;
use Filament\Facades\Filament;
use Filament\Pages\Auth\PasswordReset\ResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Livewire;

it('can render page', function () {
    $user = User::factory()->make();

    $token = Password::createToken($user);

    $this->get(Filament::getResetPasswordUrl(
        $token,
        $user,
    ))->assertSuccessful();
});

it('can reset password', function () {
    Event::fake([
        PasswordReset::class,
    ]);

    $this->assertGuest();

    $user = User::factory()->create();
    $token = Password::createToken($user);

    Livewire::test(ResetPassword::class, [
        'email' => $user->email,
        'token' => $token,
    ])
        ->set('password', 'new-password')
        ->set('passwordConfirmation', 'new-password')
        ->call('resetPassword')
        ->assertNotified()
        ->assertRedirect(Filament::getLoginUrl());

    Event::assertDispatched(PasswordReset::class);

    $this->assertCredentials([
        'email' => $user->email,
        'password' => 'new-password',
    ]);
});

it('requires request signature', function () {
    $user = User::factory()->make();
    $token = Password::createToken($user);

    $this->get(route('filament.admin.auth.password-reset.reset', [
        'email' => $user->getEmailForPasswordReset(),
        'token' => $token,
    ]))->assertForbidden();
});

it('requires valid email and token', function () {
    Event::fake([
        PasswordReset::class,
    ]);

    $this->assertGuest();

    $user = User::factory()->create();
    $token = Password::createToken($user);

    Livewire::test(ResetPassword::class, [
        'email' => $user->email,
        'token' => Str::random(),
    ])
        ->set('password', 'new-password')
        ->set('passwordConfirmation', 'new-password')
        ->call('resetPassword')
        ->assertNotified()
        ->assertNoRedirect();

    Event::assertNotDispatched(PasswordReset::class);

    Livewire::test(ResetPassword::class, [
        'email' => fake()->email(),
        'token' => $token,
    ])
        ->set('password', 'new-password')
        ->set('passwordConfirmation', 'new-password')
        ->call('resetPassword')
        ->assertNotified()
        ->assertNoRedirect();

    Event::assertNotDispatched(PasswordReset::class);
});

it('can throttle reset password attempts', function () {
    Event::fake([
        PasswordReset::class,
    ]);

    $this->assertGuest();

    foreach (range(1, 2) as $i) {
        $user = User::factory()->create();
        $token = Password::createToken($user);

        Livewire::test(ResetPassword::class, [
            'email' => $user->email,
            'token' => $token,
        ])
            ->set('password', 'new-password')
            ->set('passwordConfirmation', 'new-password')
            ->call('resetPassword')
            ->assertNotified()
            ->assertRedirect(Filament::getLoginUrl());
    }

    Event::assertDispatchedTimes(PasswordReset::class, times: 2);

    $this->assertCredentials([
        'email' => $user->email,
        'password' => 'new-password',
    ]);

    Livewire::test(ResetPassword::class, [
        'email' => $user->email,
        'token' => $token,
    ])
        ->set('password', 'newer-password')
        ->set('passwordConfirmation', 'newer-password')
        ->call('resetPassword')
        ->assertNotified()
        ->assertNoRedirect();

    Event::assertDispatchedTimes(PasswordReset::class, times: 2);

    $this->assertCredentials([
        'email' => $user->email,
        'password' => 'new-password',
    ]);
});

it('can validate `password` is required', function () {
    Livewire::test(ResetPassword::class)
        ->set('password', '')
        ->call('resetPassword')
        ->assertHasErrors(['password' => ['required']]);
});

it('can validate `password` is confirmed', function () {
    Livewire::test(ResetPassword::class)
        ->set('password', Str::random())
        ->set('passwordConfirmation', Str::random())
        ->call('resetPassword')
        ->assertHasErrors(['password' => ['same']]);
});

it('can validate `passwordConfirmation` is required', function () {
    Livewire::test(ResetPassword::class)
        ->set('passwordConfirmation', '')
        ->call('resetPassword')
        ->assertHasErrors(['passwordConfirmation' => ['required']]);
});
