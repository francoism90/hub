<?php

declare(strict_types=1);

namespace Domain\Videos\Jobs;

use Domain\Videos\Actions\ExtractVideoCaptions;
use Domain\Videos\Actions\MarkVideoAsProcessed;
use Domain\Videos\Actions\SetVideoMetadata;
use Domain\Videos\Models\Video;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Pipeline;

class ProcessVideo implements ShouldQueue
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
    public $timeout = 60 * 60;

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
        Pipeline::send($this->video)
            ->through([
                // ExtractVideoCaptions::class,
                // MarkVideoAsProcessed::class,
            ])
            ->thenReturn();
    }

    /**
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [
            (new WithoutOverlapping("video:{$this->video->getKey()}"))->shared(),
        ];
    }

    public function retryUntil(): \DateTime
    {
        return now()->addHour();
    }
}
