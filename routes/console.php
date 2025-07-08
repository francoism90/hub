<?php

declare(strict_types=1);

use Domain\Transcodes\Models\Transcode;
use Illuminate\Auth\Console\ClearResetsCommand;
use Illuminate\Cache\Console\PruneStaleTagsCommand;
use Illuminate\Database\Console\PruneCommand as PruneModels;
use Illuminate\Support\Facades\Schedule;
use Laravel\Horizon\Console\SnapshotCommand;
use Laravel\Sanctum\Console\Commands\PruneExpired;
use Laravel\Telescope\Console\PruneCommand;

Schedule::command(PruneStaleTagsCommand::class)
    ->withoutOverlapping(600)
    ->hourly()
    ->runInBackground();

Schedule::command(ClearResetsCommand::class)
    ->withoutOverlapping(600)
    ->everyFifteenMinutes()
    ->runInBackground();

Schedule::command(SnapshotCommand::class)
    ->withoutOverlapping(240)
    ->everyFiveMinutes()
    ->runInBackground();

Schedule::command(PruneExpired::class, ['--hours=24'])
    ->withoutOverlapping(1440)
    ->dailyAt('01:30')
    ->runInBackground();

Schedule::command(PruneCommand::class)
    ->withoutOverlapping(1440)
    ->dailyAt('02:00')
    ->runInBackground();

Schedule::command(PruneModels::class, [
    '--model' => [
        Transcode::class,
    ],
])
    ->withoutOverlapping(1440)
    ->dailyAt('04:30')
    ->runInBackground();
