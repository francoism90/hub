<?php

use Domain\Groups\Models\Group;
use Domain\Imports\Models\Import;
use Illuminate\Auth\Console\ClearResetsCommand;
use Illuminate\Cache\Console\PruneStaleTagsCommand;
use Illuminate\Database\Console\PruneCommand as ModelPruneCommand;
use Illuminate\Support\Facades\Schedule;
use Laravel\Horizon\Console\SnapshotCommand;
use Laravel\Sanctum\Console\Commands\PruneExpired;
use Laravel\Telescope\Console\PruneCommand;
use Spatie\DbSnapshots\Commands\Cleanup as DbCleanupCommand;
use Spatie\DbSnapshots\Commands\Create as DbSnapshotCommand;

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

Schedule::command(DbSnapshotCommand::class)
    ->withoutOverlapping(1440)
    ->dailyAt('03:30')
    ->runInBackground();

Schedule::command(DbCleanupCommand::class, ['--keep=15'])
    ->withoutOverlapping(1440)
    ->dailyAt('04:00')
    ->runInBackground();

Schedule::command(ModelPruneCommand::class, [
    '--model' => [Import::class, Group::class],
])
    ->withoutOverlapping(1440)
    ->dailyAt('04:30')
    ->runInBackground();
