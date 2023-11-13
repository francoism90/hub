<?php

use Domain\Users\Models\User;
use Filament\Facades\Filament;
use Filament\Notifications\Auth\VerifyEmail;
use Filament\Pages\Auth\EmailVerification\EmailVerificationPrompt;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

it('can render page', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $this->actingAs($user);

    $this->get(Filament::getEmailVerificationPromptUrl())
        ->assertSuccessful();
});

it('can resend notification', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $this->actingAs($user);

    Livewire::test(EmailVerificationPrompt::class)
        ->callAction('resendNotification')
        ->assertNotified();

    Notification::assertSentTo($user, VerifyEmail::class);
});

it('can throttle resend notification attempts', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    $this->actingAs($user);

    foreach (range(1, 2) as $i) {
        Livewire::test(EmailVerificationPrompt::class)
            ->callAction('resendNotification')
            ->assertNotified();
    }

    Notification::assertSentToTimes($user, VerifyEmail::class, times: 2);

    Livewire::test(EmailVerificationPrompt::class)
        ->callAction('resendNotification')
        ->assertNotified();

    Notification::assertSentToTimes($user, VerifyEmail::class, times: 2);
});
