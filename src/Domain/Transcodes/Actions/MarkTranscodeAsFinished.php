<?php

declare(strict_types=1);

namespace Domain\Transcodes\Actions;

use Closure;
use Domain\Transcodes\Events\TranscodeHasBeenProcessed;
use Domain\Transcodes\Models\Transcode;

class MarkTranscodeAsFinished
{
    public function handle(Transcode $transcode, Closure $next): mixed
    {
        $transcode->updateOrFail([
            'finished_at' => now(),
        ]);

        TranscodeHasBeenProcessed::dispatch($transcode);

        return $next($transcode);
    }
}
