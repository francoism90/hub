<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Groups\Models\Group;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkAsSaved
{
    public function execute(User $user, Video $video, ?bool $force = null): void
    {
        DB::transaction(function () use ($user, $video, $force) {
            $group = $this->getGroup($user);

            if (! $group instanceof Group) {
                return;
            }

            // Toggle state
            $force === true || ! $this->isSaved($user, $video)
                ? $video->attachGroup($group)
                : $video->detachGroup($group);

            // Touch parent to trigger broadcast
            $group->touch();
        });
    }

    protected function getGroup(User $user): ?Group
    {
        return $user->groups()->saves()->first();
    }

    protected function isSaved(User $user, Video $video): bool
    {
        return $user->groups()
            ->saves()
            ->whereHas('videos', fn ($query) => $query->where('id', $video->getKey()))
            ->exists();
    }
}
