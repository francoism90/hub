<?php

declare(strict_types=1);

namespace Domain\Transcodes\Observers;

use Domain\Transcodes\Models\Transcode;

class TranscodeObserver
{
    public function deleted(Transcode $transcode): void
    {
        if (method_exists($transcode, 'isForceDeleting') && ! $transcode->isForceDeleting()) {
            return;
        }

        $transcode->getFilesystem()->deleteDirectory($transcode->getPath());
    }
}
