<?php

namespace Domain\Videos\Commands;

use Domain\Videos\Actions\RegenerateVideo;
use Domain\Videos\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class RegenerateVideos extends Command implements Isolatable, PromptsForMissingInput
{
    /**
     * @var string
     */
    protected $signature = 'videos:regenerate {video}';

    /**
     * @var string
     */
    protected $description = 'Regenerate a video';

    public function handle(): void
    {
        $model = Video::findByPrefixedIdOrFail(
            $this->argument('video')
        );

        app(RegenerateVideo::class)->execute($model);

        $this->info("Regenerating video ({$model->getKey()})");
    }
}
