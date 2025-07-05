<?php

declare(strict_types=1);

namespace Domain\Transcodes\Events;

use Domain\Transcodes\Models\Transcode;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TranscodeHasBeenProcessed implements ShouldDispatchAfterCommit
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(public Transcode $transcode) {}
}
