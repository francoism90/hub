<?php

declare(strict_types=1);

namespace Domain\Groups\Actions;

use Domain\Groups\Enums\GroupCategory;
use Domain\Groups\Models\Group;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class SyncGroupCategory
{
    public function execute(User $user, GroupCategory $category): void
    {
        DB::transaction(function () use ($user, $category) {
            if (! $force && $model->videos()->exists()) {
                return;
            }

            if ($model->videos()->count() > $this->getLimit()) {
                $model->videos()->detach();
            }

            switch ($model->name) {
                case 'daily':
                    $model->attachVideos(Video::query()->daily()->pluck('id'));
                    break;
                case 'discover':
                    $model->attachVideos(Video::query()->daily()->pluck('id'));
                    break;
            }
        });
    }

    protected function getLimit(): int
    {
        return config('library.mixer.limit', 48);
    }
}
