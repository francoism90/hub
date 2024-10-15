<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Domain\Videos\DataObjects\VideoableData;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkAsWatched
{
    public function execute(User $user, Video $video, ?VideoableData $data = null, ?bool $force = null): void    {
        DB::transaction(function () use ($user, $video, $data, $force) {
            $model = $user->groups()->history();

            // Toggle state
            $force === true || ! $model->exists()
                ? $model->attachVideo($video, $data)
                : $model->detachVideo($video);

            // Touch parent to trigger broadcast
            $model->touch();
        });
    }
}
