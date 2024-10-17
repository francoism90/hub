<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupType;
use Domain\Groups\Models\Group;
use Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class RemoveMixerGroups
{
    public function execute(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->getCollection($user)->each(
                fn (Group $model) => $model->delete()
            );
        });
    }

    protected function getCollection(User $user): LazyCollection
    {
        return Group::query()
            ->where('user_id', $user->getKey())
            ->where('type', GroupType::Mixer)
            ->cursor();
    }
}
