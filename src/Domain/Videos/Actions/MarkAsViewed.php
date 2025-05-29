<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkAsViewed
{
    public function execute(User $user, Video $video): void
    {
        DB::transaction(function () use ($user, $video) {
            // Get group model
            $group = $user->groups()->viewed();

            // Attach video to group
            $video->attachGroup($group);

            // Touch parent to trigger broadcast
            $group->touch();
        });
    }
}
