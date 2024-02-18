<?php

namespace Foundation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class AppUpdate extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'app:update {--force}';

    /**
     * @var string
     */
    protected $description = 'Updates the application';

    public function handle(): void
    {
        throw_if(! $this->option('force') && ! $this->confirm('Are you sure to update the application?'));

        // Optimize app
        $this->call('app:optimize');

        // Run migrations
        $this->call('migrate', ['--seed']);

        // Sync Scout
        $this->call('scout:sync');
    }
}