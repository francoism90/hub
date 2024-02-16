<?php

namespace Foundation\Console;

use Domain\Imports\Models\Import;
use Foundation\Console\Commands\AppInstall;
use Foundation\Console\Commands\AppOptimize;
use Foundation\Console\Commands\AppUpdate;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Support\Scout\Commands\SyncIndexes;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AppInstall::class,
        AppUpdate::class,
        AppOptimize::class,
        SyncIndexes::class,
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
            ->command('activitylog:clean')
            ->withoutOverlapping(1440)
            ->dailyAt('02:30')
            ->runInBackground();

        $schedule
            ->command('snapshot:create')
            ->withoutOverlapping(1440)
            ->dailyAt('03:30')
            ->runInBackground();

        $schedule
            ->command('snapshot:cleanup --keep=10')
            ->withoutOverlapping(1440)
            ->dailyAt('04:00')
            ->runInBackground();

        $schedule
            ->command('model:prune', [
                '--model' => [Import::class],
            ])
            ->withoutOverlapping(1440)
            ->dailyAt('04:30')
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
