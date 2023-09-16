<?php

namespace Domain\Users\Jobs;

use Domain\Users\Actions\RegenerateUser;
use Domain\Users\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class ProcessUser implements ShouldQueue
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
     * @var bool
     */
    public $failOnTimeout = true;

    /**
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    public function __construct(
        protected User $model,
    ) {
        $this->onQueue('processing');
    }

    public function handle(): void
    {
        app(RegenerateUser::class)
            ->onProgress(fn (string $progress) => logger($progress))
            ->execute($this->model);
    }

    /**
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [
            (new WithoutOverlapping("process:{$this->model->getKey()}"))->shared(),
        ];
    }

    public function retryUntil(): \DateTime
    {
        return now()->addHour();
    }
}
