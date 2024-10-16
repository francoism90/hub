<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Groups\Actions\CreateNewGroup;
use Domain\Groups\Enums\GroupSet;
use Domain\Groups\Enums\GroupType;
use Domain\Users\Models\User;
use Domain\Videos\DataObjects\VideoableData;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkAsFavorited
{
    public function execute(User $user, Video $video, ?VideoableData $data = null, ?bool $force = null): void
    {
        DB::transaction(function () use ($user, $video, $data, $force) {
            // Make sure group model exists
            $model = app(CreateNewGroup::class)->execute($user, [
                'kind' => GroupSet::Favorite,
                'type' => GroupType::System,
            ]);

            // Toggle state
            $force === true || ! $video->isFavoritedBy($user)
                ? $model->attachVideo($video, $data)
                : $model->detachVideo($video);

            // Touch parent to trigger broadcast
            $model->touch();
        });
    }
}
