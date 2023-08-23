<?php

namespace Domain\Videos\Commands;

use Domain\Videos\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\LazyCollection;

class CleanVideos extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'videos:clean';

    /**
     * @var string
     */
    protected $description = 'Cleanup deleted videos';

    public function handle(): void
    {
        $models = $this->getTrashedModels();

        if ($models->isEmpty()) {
            $this->info('No videos to permanently remove');

            return;
        }

        $this->warn("About to permanently remove {$models->count()} videos");

        if ($this->confirm('Do you wish to continue?')) {
            $this->withProgressBar($models, fn (Video $model) => $model->forceDelete());
        }
    }

    protected function getTrashedModels(): LazyCollection
    {
        return Video::onlyTrashed()->cursor();
    }
}
