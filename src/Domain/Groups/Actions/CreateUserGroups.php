<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;

class CreateUserGroups
{
    public function execute(User $user): void
    {
        DB::transaction(function () use ($user) {
            collect($this->getGroups())->each(
                fn (GroupSet $group) => app(CreateNewGroup::class)->execute($user, [
                    'name' => $group->label(),
                    'kind' => $group,
                    'type' => GroupType::System,
                ])
            );
        });
    }

    protected function getGroups(): array
    {
        return [
            GroupSet::Favorite,
            GroupSet::Saved,
            GroupSet::Viewed,
        ];
    }
}
