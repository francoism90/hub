<?php

declare(strict_types=1);

namespace Domain\Transcodes\Actions;

use Closure;
use Domain\Videos\Models\Video;

class MarkVideoAsTranscoded
{
    public function handle(Video $video, Closure $next): mixed
    {
        // $transcode->updateOrFail([
        //     'finished_at' => now(),
        // ]);

        return $next($video);
    }
}
