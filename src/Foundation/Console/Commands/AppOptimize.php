<?php

namespace Foundation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class AppOptimize extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'app:optimize';

    /**
     * @var string
     */
    protected $description = 'Optimizes application';

    public function handle(): void
    {
        // Clear caches
        $this->call('optimize:clear');
        $this->call('permission:cache-reset');
        $this->call('structures:refresh');

        // Optimize packages
        $this->call('icons:cache');

        // Optimize caches
        $this->call('config:cache');
        $this->call('route:cache');
        $this->call('view:cache');
        $this->call('event:cache');

        // Sync settings
        $this->call('scout:sync-index-settings');

        // Restart services
        $this->call('octane:reload');
        $this->call('reverb:restart');
        $this->call('horizon:terminate');
    }
}
