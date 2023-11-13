<?php

use Domain\Users\Models\User;
use Filament\Facades\Filament;
use Filament\Pages\Auth\Login;
use Filament\Pages\Dashboard;
use Illuminate\Support\Str;
use Livewire\Livewire;

it('can render page', function () {
    $this->get(Filament::getLoginUrl())
        ->assertSuccessful();
});

it('can authenticate', function () {
    $this->assertGuest();

    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => 'password',
        ])
        ->call('authenticate')
        ->assertRedirect(Filament::getUrl());

    $this->assertAuthenticatedAs($user);
});

it('can authenticate and redirect user to their intended URL', function () {
    session()->put('url.intended', $intendedUrl = Str::random());

    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => 'password',
        ])
        ->call('authenticate')
        ->assertRedirect($intendedUrl);
});

it('can redirect unauthenticated app requests', function () {
    $this->get(Dashboard::getUrl())->assertRedirect(Filament::getLoginUrl());
});

it('cannot authenticate with incorrect credentials', function () {
    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => 'incorrect-password',
        ])
        ->call('authenticate')
        ->assertHasFormErrors(['email']);

    $this->assertGuest();
});

it('cannot authenticate on unauthorized panel', function () {
    $user = User::factory()->create();

    Filament::setCurrentPanel(Filament::getPanel('workspace'));

    Livewire::test(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => 'passW00rd',
        ])
        ->call('authenticate')
        ->assertHasFormErrors(['email']);

    $this->assertGuest();
});

it('can throttle authentication attempts', function () {
    $this->assertGuest();

    $user = User::factory()->create();

    foreach (range(1, 5) as $i) {
        Livewire::test(Login::class)
            ->fillForm([
                'email' => $user->email,
                'password' => 'password',
            ])
            ->call('authenticate');

        $this->assertAuthenticated();

        auth()->logout();
    }

    Livewire::test(Login::class)
        ->fillForm([
            'email' => $user->email,
            'password' => 'password',
        ])
        ->call('authenticate')
        ->assertNotified();

    $this->assertGuest();
});

it('can validate `email` is required', function () {
    Livewire::test(Login::class)
        ->fillForm(['email' => ''])
        ->call('authenticate')
        ->assertHasFormErrors(['email' => ['required']]);
});

it('can validate `email` is valid email', function () {
    Livewire::test(Login::class)
        ->fillForm(['email' => 'invalid-email'])
        ->call('authenticate')
        ->assertHasFormErrors(['email' => ['email']]);
});

it('can validate `password` is required', function () {
    Livewire::test(Login::class)
        ->fillForm(['password' => ''])
        ->call('authenticate')
        ->assertHasFormErrors(['password' => ['required']]);
});
