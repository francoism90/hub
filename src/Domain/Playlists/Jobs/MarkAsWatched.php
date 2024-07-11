<?php

namespace Domain\Playlists\Jobs;

use Domain\Playlists\Actions\UpdatePlaylistHistory;
use Domain\Users\Models\User;
use Domain\Videos\Models\Video;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MarkAsWatched implements ShouldQueue
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
    public $timeout = 60 * 10;

    /**
     * @var int
     */
    public $backoff = 60;

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
        app(UpdatePlaylistHistory::class)->execute($this->user, $this->video);
    }

    public function retryUntil(): \DateTime
    {
        return now()->addDay();
    }
}
