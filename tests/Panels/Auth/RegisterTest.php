<?php

use App\Filament\Pages\Auth\Register;
use Domain\Users\Models\User;
use Filament\Facades\Filament;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Livewire\Livewire;

it('can render page', function () {
    $this->get(Filament::getRegistrationUrl())
        ->assertSuccessful();
});

it('can register', function () {
    Event::fake([
        Registered::class,
    ]);

    $this->assertGuest();

    Filament::getCurrentPanel()->requiresEmailVerification(false);

    $user = User::factory()->make();

    Livewire::test(Register::class)
        ->fillForm([
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'passwordConfirmation' => 'password',
        ])
        ->call('register')
        ->assertRedirect(Filament::getUrl());

    Event::assertDispatched(Registered::class);

    $this->assertAuthenticated();

    $this->assertCredentials([
        'email' => $user->email,
        'password' => 'password',
    ]);
});

it('can register and redirect user to their intended URL', function () {
    session()->put('url.intended', $intendedUrl = Str::random());

    Filament::getCurrentPanel()->requiresEmailVerification(false);

    $user = User::factory()->make();

    Livewire::test(Register::class)
        ->fillForm([
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'passwordConfirmation' => 'password',
        ])
        ->call('register')
        ->assertRedirect($intendedUrl);
});

it('can throttle registration attempts', function () {
    Event::fake([
        Registered::class,
    ]);

    $this->assertGuest();

    foreach (range(1, 2) as $i) {
        $user = User::factory()->make();

        Livewire::test(Register::class)
            ->fillForm([
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'password',
                'passwordConfirmation' => 'password',
            ])
            ->call('register')
            ->assertRedirect(Filament::getUrl());

        $this->assertAuthenticated();

        auth()->logout();
    }

    Event::assertDispatchedTimes(Registered::class, times: 2);

    Livewire::test(Register::class)
        ->fillForm([
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'passwordConfirmation' => 'password',
        ])
        ->call('register')
        ->assertNotified()
        ->assertNoRedirect();

    Event::assertDispatchedTimes(Registered::class, times: 2);

    $this->assertGuest();
});

it('can validate `email` is required', function () {
    Livewire::test(Register::class)
        ->fillForm(['email' => ''])
        ->call('register')
        ->assertHasFormErrors(['email' => ['required']]);
});

it('can validate `email` is valid email', function () {
    Livewire::test(Register::class)
        ->fillForm(['email' => 'invalid-email'])
        ->call('register')
        ->assertHasFormErrors(['email' => ['email']]);
});

it('can validate `email` is max 255 characters', function () {
    Livewire::test(Register::class)
        ->fillForm(['email' => Str::random(256)])
        ->call('register')
        ->assertHasFormErrors(['email' => ['max']]);
});

it('can validate `email` is unique', function () {
    $existingEmail = User::factory()->create()->email;

    Livewire::test(Register::class)
        ->fillForm(['email' => $existingEmail])
        ->call('register')
        ->assertHasFormErrors(['email' => ['unique']]);
});

it('can validate `password` is required', function () {
    Livewire::test(Register::class)
        ->fillForm(['password' => ''])
        ->call('register')
        ->assertHasFormErrors(['password' => ['required']]);
});

it('can validate `password` is confirmed', function () {
    Livewire::test(Register::class)
        ->fillForm([
            'password' => Str::random(),
            'passwordConfirmation' => Str::random(),
        ])
        ->call('register')
        ->assertHasFormErrors(['password' => ['same']]);
});

it('can validate `passwordConfirmation` is required', function () {
    Livewire::test(Register::class)
        ->fillForm(['passwordConfirmation' => ''])
        ->call('register')
        ->assertHasFormErrors(['passwordConfirmation' => ['required']]);
});
