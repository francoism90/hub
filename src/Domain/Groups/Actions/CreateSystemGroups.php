<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;

class CreateSystemGroups
{
    public function execute(User $user): void
    {
        DB::transaction(function () use ($user) {
            collect($this->getCollection())->each(
                fn (GroupSet $group) => app(CreateNewGroup::class)->execute($user, [
                    'name' => $group->label(),
                    'kind' => $group,
                    'type' => GroupType::System,
                ])
            );
        });
    }

    protected function getCollection(): array
    {
        return [
            GroupSet::Favorite,
            GroupSet::Saved,
            GroupSet::Viewed,
        ];
    }
}
