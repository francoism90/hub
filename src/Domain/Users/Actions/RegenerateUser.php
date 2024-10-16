<?php

namespace Domain\Users\Actions;

use Domain\Groups\Actions\CreateSystemGroups;
use Domain\Users\Models\User;

class RegenerateUser
{
    public array $actions = [
        CreateSystemGroups::class,
    ];

    public function execute(User $model): void
    {
        foreach ($this->actions as $action) {
            app($action)->execute($model);
        }
    }
}
