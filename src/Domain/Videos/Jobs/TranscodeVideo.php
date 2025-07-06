<?php

declare(strict_types=1);

namespace Domain\Videos\Jobs;

use Domain\Videos\Actions\CreateVideoManifest;
use Domain\Videos\Models\Video;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\Skip;
use Illuminate\Queue\SerializesModels;

class TranscodeVideo implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var int
     */
    public $maxExceptions = 1;

    /**
     * @var int
     */
    public $timeout = 60 * 60 * 4;

    /**
     * @var bool
     */
    public $failOnTimeout = true;

    /**
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    public function __construct(
        protected Video $video,
    ) {
        $this->onQueue('processing');
    }

    public function handle(): void
    {
        app(CreateVideoManifest::class)->handle($this->video);
    }

    /**
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [
            Skip::when($this->video->hasBeenTranscoded() || ! $this->video->hasMedia('clips')),
        ];
    }

    public function retryUntil(): \DateTime
    {
        return now()->addHour();
    }
}
