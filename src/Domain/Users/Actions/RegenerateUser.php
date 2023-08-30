<?php

namespace Domain\Users\Actions;

use Domain\Shared\Concerns\InteractsWithProgress;
use Domain\Users\Models\User;

class RegenerateUser
{
    use InteractsWithProgress;

    public array $actions = [
        CreatePlaylists::class,
    ];

    public function execute(User $model): void
    {
        foreach ($this->actions as $action) {
            app($action)->execute($model);

            $this->callOnProgressHook("Ran {$action}.");
        }
    }
}
