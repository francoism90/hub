<?php

namespace Support\Scout\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class SyncIndexes extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'scout:sync';

    /**
     * @var string
     */
    protected $description = 'Sync Scout indexes';

    public function handle(): void
    {
        $this->call('scout:sync-index-settings');

        $classes = collect([
            \Domain\Users\Models\User::class,
            \Domain\Tags\Models\Tag::class,
            \Domain\Videos\Models\Video::class,
        ]);

        $classes->each(fn (string $class) => $this->call('scout:import', ['model' => $class]));
    }
}
