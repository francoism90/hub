<?php

declare(strict_types=1);

namespace Domain\Users\Events;

use Domain\Users\Models\User;
use Illuminate\Queue\SerializesModels;

class UserHasBeenProcessed
{
    use SerializesModels;

    public function __construct(public User $user) {}
}
