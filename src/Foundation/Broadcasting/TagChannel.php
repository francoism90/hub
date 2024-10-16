<?php

declare(strict_types=1);

namespace Foundation\Broadcasting;

use Domain\Tags\Models\Tag;
use Domain\Users\Models\User;

class TagChannel
{
    public function join(User $user, Tag $model): bool
    {
        return true;
    }
}
