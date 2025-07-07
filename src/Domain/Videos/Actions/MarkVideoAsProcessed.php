<?php

declare(strict_types=1);

namespace Domain\Videos\Actions;

use Closure;
use Domain\Videos\Events\VideoHasBeenProcessed;
use Domain\Videos\Models\Video;

class MarkVideoAsProcessed
{
    public function __invoke(Video $video, Closure $next): mixed
    {
        $video->updateOrFail([
            'finished_at' => now(),
        ]);

        VideoHasBeenProcessed::dispatch($video);

        return $next($video);
    }
}
