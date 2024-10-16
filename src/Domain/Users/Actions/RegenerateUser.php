<?php

namespace Domain\Users\Actions;

use Domain\Groups\Actions\InitializeGroups;
use Domain\Users\Models\User;

class RegenerateUser
{
    public function execute(User $model): void
    {
        foreach ($this->getActions() as $action) {
            app($action)->execute($model);
        }
    }

    protected function getActions(): array
    {
        return [
            InitializeGroups::class,
        ];
    }
}
