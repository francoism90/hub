<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Domain\Videos\DataObjects\VideoableData;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkAsViewed
{
    public function execute(User $user, Video $video, ?VideoableData $data = null): void
    {
        DB::transaction(function () use ($user, $video, $data) {
            // Get group model
            $model = $user->groups()->viewed();

            // Update videos
            $model->attachVideo($video, $data);

            // Touch parent to trigger broadcast
            $model->touch();
        });
    }
}
