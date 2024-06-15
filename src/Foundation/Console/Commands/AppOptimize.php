<?php

namespace Foundation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class AppOptimize extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'app:optimize {--force}';

    /**
     * @var string
     */
    protected $description = 'Optimizes application';

    public function handle(): void
    {
        throw_if(! $this->option('force') && ! $this->confirm('Are you sure to optimize the application?'));

        // Clear cache
        $this->call('permission:cache-reset');
        $this->call('structure-scouts:clear');

        // Optimize application
        $this->call('config:cache');
        $this->call('route:cache');
        $this->call('view:cache');
        $this->call('event:cache');

        // Optimize assets
        $this->call('icons:cache');
        $this->call('structure-scouts:cache');

        // Terminate Horizon
        $this->call('horizon:terminate');
    }
}
