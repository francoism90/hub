<?php

declare(strict_types=1);

namespace Domain\Videos\Jobs;

use Domain\Activities\Actions\MarkAsViewed;
use Domain\Users\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessViewed implements ShouldBeEncrypted, ShouldBeUnique, ShouldQueue
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
        protected Model $model,
        protected ?array $options = null,
    ) {
        $this->onQueue('processing');
    }

    public function handle(): void
    {
        app(MarkAsViewed::class)->execute($this->user, $this->model, $this->options);
    }

    public function uniqueId(): string
    {
        return sprintf('watched-%s-%d-%d',
            $this->model->getMorphClass(),
            $this->model->getKey(),
            $this->user->getKey(),
        );
    }
}
