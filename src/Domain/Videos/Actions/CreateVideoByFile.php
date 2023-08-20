<?php

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Jobs\OptimizeVideo;
use Domain\Videos\Jobs\ProcessVideo;
use Domain\Videos\Jobs\ReleaseVideo;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Finder\SplFileInfo;

class CreateVideoByFile
{
    public function execute(SplFileInfo $file, int $userId, bool $adult = false): void
    {
        DB::transaction(function () use ($file, $userId, $adult) {
            // Find user
            $user = User::findOrFail($userId);

            // Create model
            $model = $user->videos()->create([
                'name' => $file->getFilenameWithoutExtension(),
                'adult' => $adult,
            ]);

            // Attach media
            $model
                ->addMedia($file->getRealPath())
                ->toMediaCollection('clips');

            // Process model
            Bus::chain([
                new ProcessVideo($model),
                new OptimizeVideo($model),
                new ReleaseVideo($model),
            ])->dispatch();
        });
    }
}
