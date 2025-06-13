<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MarkAsViewed
{
    public function execute(User $user, Model $model, ?bool $force = null): void
    {
        DB::transaction(function () use ($user, $model, $force) {
            // Ensure the group exists
            $group = app(CreateNewGroup::class)->execute($user, [
                'kind' => GroupSet::Viewed,
                'type' => GroupType::System,
            ]);

            // Toggle state
            $force === true || ! $user->hasViewed($model)
                ? $model->attachGroup($group)
                : $model->detachGroup($group);

            // Touch parent to trigger broadcast
            $group->touch();
        });
    }
}
