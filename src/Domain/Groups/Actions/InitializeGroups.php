<?php

namespace Domain\Groups\Actions;

use Domain\Groups\Actions\CreateNewGroup;
use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class InitializeGroups
{
    public function execute(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->getCollection()->each(fn (GroupSet $set) => app(CreateNewGroup::class)->execute($user, [
                'kind' => $set,
                'type' => GroupType::Private,
            ]));
        });
    }

    protected function getCollection(): LazyCollection
    {
        return collect(GroupSet::cases())->lazy();
    }
}
