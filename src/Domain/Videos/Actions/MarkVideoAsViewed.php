<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Domain\Users\Models\User;
use Domain\Videos\Jobs\TranscodeVideo;
use Domain\Videos\Models\Video;
use Illuminate\Support\Facades\DB;

class MarkVideoAsViewed
{
    public function execute(User $user, Video $video): void
    {
        DB::transaction(function () use ($video) {
            // Transcode the video (if needed)
            TranscodeVideo::dispatchIf(! $video->currentTranscode(), $video);
        });
    }
}
