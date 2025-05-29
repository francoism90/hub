<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Groups\Models\Group;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkAsViewed
{
    public function execute(User $user, Video $video): void
    {
        DB::transaction(function () use ($user, $video) {
            $group = $user->groups()->views()->first();

            if (! $group instanceof Group) {
                return;
            }

            // Attach video to group
            $video->attachGroup($group);

            // Touch parent to trigger broadcast
            $group->touch();
        });
    }
}
