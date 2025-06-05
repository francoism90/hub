<?php

declare(strict_types=1);

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
        // Optimize caches
        $this->call('config:cache');
        $this->call('route:cache');
        $this->call('view:cache');
        $this->call('event:cache');

        // Optimize packages
        $this->call('structures:cache');
        $this->call('icons:cache');

        // Reload services
        $this->call('horizon:terminate');
        $this->call('reverb:restart');
        $this->call('octane:reload');
    }
}
