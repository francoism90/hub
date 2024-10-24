<?php

declare(strict_types=1);

namespace Domain\Videos\Jobs;

use Domain\Users\Models\User;
use Domain\Videos\Actions\MarkAsViewed;
use Domain\Videos\DataObjects\VideoableData;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreVideo implements ShouldBeEncrypted, ShouldBeUnique, ShouldQueue
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
        protected ?VideoableData $data = null,
    ) {
        $this->onQueue('processing');
    }

    public function handle(): void
    {
        app(MarkAsViewed::class)->execute($this->user, $this->model, $this->data);
    }

    public function uniqueId(): string
    {
        return sprintf('store-video-%d-%d',
            $this->model->getKey(),
            $this->user->getKey(),
        );
    }
}
