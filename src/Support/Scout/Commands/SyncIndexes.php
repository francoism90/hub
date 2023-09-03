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

        $driver = config('scout.driver');

        $indexes = (array) config('scout.'.$driver.'.index-settings', []);

        if (count($indexes)) {
            foreach ($indexes as $name => $settings) {
                if (class_exists($name)) {
                    $this->call('scout:import', ['model' => $name]);
                }
            }
        }
    }
}
