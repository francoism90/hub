<?php

namespace Domain\Users\Actions;

use Domain\Users\Jobs\OptimizeUser;
use Domain\Users\Jobs\ProcessUser;
use Domain\Users\Jobs\ReleaseUser;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\Bus;

class RegenerateUser
{
    public function execute(User $user): void
    {
        if ($user->trashed()) {
            return;
        }

        Bus::chain([
            new ProcessUser($user),
            new OptimizeUser($user),
            new ReleaseUser($user),
        ])->dispatch();
    }
}
