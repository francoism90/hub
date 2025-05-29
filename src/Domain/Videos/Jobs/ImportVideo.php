<?php

declare(strict_types=1);

namespace Domain\Videos\Jobs;

use Domain\Imports\Events\ImportHasBeenProcessed;
use Domain\Imports\Models\Import;
use Domain\Videos\Actions\CreateVideoByImport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Pipeline;

class ImportVideo implements ShouldQueue
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
        protected Import $import,
    ) {
        $this->onQueue('processing');
    }

    public function handle(): void
    {
        Pipeline::send($this->import)
            ->through([
                CreateVideoByImport::class,
            ])
            ->then(fn (Import $import) => event(new ImportHasBeenProcessed($import)));
    }

    /**
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [
            (new WithoutOverlapping("process:{$this->import->getKey()}"))->shared(),
        ];
    }

    public function retryUntil(): \DateTime
    {
        return now()->addHour();
    }
}
