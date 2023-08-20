<?php

namespace Domain\Videos\Commands;

use Domain\Videos\Jobs\OptimizeVideo;
use Domain\Videos\Jobs\ProcessVideo;
use Domain\Videos\Jobs\ReleaseVideo;
use Domain\Videos\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Bus;

class RegenerateVideos extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'videos:regenerate {--id=*}';

    /**
     * @var string
     */
    protected $description = 'Regenerate video models';

    public function handle(): void
    {
        $ids = $this->option('id');

        Video::query()
            ->with('media')
            ->when($ids, fn (Builder $query) => $query->whereIn('id', $ids))
            ->lazy()
            ->each(fn (Video $model) => Bus::chain([
                new ProcessVideo($model),
                new OptimizeVideo($model),
                new ReleaseVideo($model),
            ])->dispatch());
    }
}
