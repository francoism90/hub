<?php

namespace Foundation\Console;

use Domain\Media\Commands\MissingModels;
use Domain\Tags\Commands\CreateTag;
use Domain\Tags\Commands\SortTags;
use Domain\Videos\Commands\CleanVideos;
use Domain\Videos\Commands\RegenerateVideos;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Support\Scout\Commands\SyncIndexes;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SyncIndexes::class,
        RegenerateVideos::class,
        CleanVideos::class,
        MissingModels::class,
        CreateTag::class,
        SortTags::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule
            ->command('cache:prune-stale-tags')
            ->withoutOverlapping(30)
            ->hourly()
            ->runInBackground();

        $schedule
            ->command('auth:clear-resets')
            ->withoutOverlapping(600)
            ->everyFifteenMinutes()
            ->runInBackground();

        $schedule
            ->command('horizon:snapshot')
            ->withoutOverlapping(240)
            ->everyFiveMinutes()
            ->runInBackground();

        $schedule
            ->command('sanctum:prune-expired --hours=24')
            ->withoutOverlapping(1440)
            ->dailyAt('01:30')
            ->runInBackground();

        $schedule
            ->command('telescope:prune')
            ->withoutOverlapping(1440)
            ->dailyAt('02:00')
            ->runInBackground();

        $schedule
            ->command('snapshot:create')
            ->withoutOverlapping(1440)
            ->dailyAt('03:30')
            ->runInBackground();

        $schedule
            ->command('snapshot:cleanup --keep=7')
            ->withoutOverlapping(1440)
            ->dailyAt('04:00')
            ->runInBackground();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
