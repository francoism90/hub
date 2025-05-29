<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkAsFavorited
{
    public function execute(User $user, Video $video, ?bool $force = null): void
    {
        DB::transaction(function () use ($user, $video, $force) {
            // Get group model
            $model = $user->groups()->favorites();

            // Toggle state
            // $force === true || ! $video->isFavoritedBy($user)
            //     ? $model->attachVideo($video)
            //     : $model->detachVideo($video);

            // Touch parent to trigger broadcast
            $model->touch();
        });
    }
}
