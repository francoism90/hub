<?php

namespace Domain\Groups\Jobs;

use Domain\Groups\Actions\SyncWatchHistory;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarkWatched implements ShouldBeEncrypted, ShouldBeUnique, ShouldQueue
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
    public $backoff = 60;

    /**
     * @var int
     */
    public $uniqueFor = 30;

    /**
     * @var bool
     */
    public $failOnTimeout = true;

    /**
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    public function __construct(
        protected User $user,
        protected Video $video,
    ) {
        $this->onQueue('processing');
    }

    public function handle(): void
    {
        app(SyncWatchHistory::class)->execute($this->user, $this->video);
    }

    public function uniqueId(): string
    {
        return sprintf('watched-%s-%s', $this->user->getKey(), $this->video->getKey());
    }
}
