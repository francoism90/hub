<?php

namespace Foundation\Providers;

use Domain\Users\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Pulse\Facades\Pulse;

class PulseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureAuthentication();
        $this->configureUsers();
    }

    protected function configureAuthentication(): void
    {
        Gate::define('viewPulse', function (User $user) {
            return $user->hasRole('super-admin');
        });
    }

    protected function configureUsers(): void
    {
        Pulse::user(fn (User $user) => [
            'name' => $user->name,
            'extra' => $user->email,
            'avatar' => $user->avatar,
        ]);
    }
}
