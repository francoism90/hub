<?php

namespace Domain\Videos\Jobs;

use Domain\Videos\Actions\CreateVideoThumbnail;
use Domain\Videos\Models\Video;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class OptimizeVideo implements ShouldQueue
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
    public $timeout = 60 * 30;

    /**
     * @var int
     */
    public $backoff = 30;

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
        app(CreateVideoThumbnail::class)->execute($this->video);
    }

    /**
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [
            new WithoutOverlapping($this->video->getKey()),
        ];
    }

    public function retryUntil(): \DateTime
    {
        return now()->addHour();
    }
}
