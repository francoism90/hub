<?php

use Domain\Imports\Models\Import;
use Foundation\Console\Commands\AppInstall;
use Foundation\Console\Commands\AppOptimize;
use Foundation\Console\Commands\AppUpdate;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Support\Scout\Commands\SyncIndexes;

Artisan::registerCommand(AppInstall::class);
Artisan::registerCommand(AppUpdate::class);
Artisan::registerCommand(AppOptimize::class);
Artisan::registerCommand(SyncIndexes::class);

schedule::command('cache:prune-stale-tags')
    ->withoutOverlapping(30)
    ->hourly()
    ->runInBackground();

schedule::command('auth:clear-resets')
    ->withoutOverlapping(600)
    ->everyFifteenMinutes()
    ->runInBackground();

schedule::command('horizon:snapshot')
    ->withoutOverlapping(240)
    ->everyFiveMinutes()
    ->runInBackground();

schedule::command('sanctum:prune-expired --hours=24')
    ->withoutOverlapping(1440)
    ->dailyAt('01:30')
    ->runInBackground();

schedule::command('telescope:prune')
    ->withoutOverlapping(1440)
    ->dailyAt('02:00')
    ->runInBackground();

schedule::command('activitylog:clean')
    ->withoutOverlapping(1440)
    ->dailyAt('02:30')
    ->runInBackground();

schedule::command('snapshot:create')
    ->withoutOverlapping(1440)
    ->dailyAt('03:30')
    ->runInBackground();

schedule::command('snapshot:cleanup --keep=10')
    ->withoutOverlapping(1440)
    ->dailyAt('04:00')
    ->runInBackground();

schedule::command('model:prune', [
        '--model' => [Import::class],
    ])
    ->withoutOverlapping(1440)
    ->dailyAt('04:30')
    ->runInBackground();
