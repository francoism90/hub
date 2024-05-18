<?php

namespace Domain\Videos\Commands;

use Domain\Videos\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class Clean extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'videos:clean {--force=true}';

    /**
     * @var string
     */
    protected $description = 'Delete trashed videos';

    public function handle(): void
    {
        $collect = Video::onlyTrashed()->lazy();

        throw_if(! $this->confirm("Are you sure to delete {$collect->count()} videos?"));

        $collect->each(function (Video $model) {
            if ($model->trashed()) {
                $this->info("processing {$model->name}");
                $model->forceDelete();
            }
        });
    }
}
