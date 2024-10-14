<?php

declare(strict_types=1);

namespace Foundation\Providers;

use Domain\Users\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;

class PulseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->authorization();

        Pulse::user(fn (User $user) => [
            'name' => $user->name,
            'extra' => $user->email,
            'avatar' => $user->avatar,
        ]);
    }

    protected function authorization(): void
    {
        Gate::define('viewPulse', fn (User $user) => $user->hasRole('super-admin'));
    }
}
