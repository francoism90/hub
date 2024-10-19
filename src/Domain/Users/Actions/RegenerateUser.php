<?php

namespace Domain\Users\Actions;

use Domain\Groups\Actions\CreateUserGroups;
use Domain\Users\Models\User;

class RegenerateUser
{
    public array $actions = [
        CreateUserGroups::class,
    ];

    public function execute(User $model): void
    {
        foreach ($this->actions as $action) {
            app($action)->execute($model);
        }
    }
}
