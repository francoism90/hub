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
        // Clear caches
        $this->call('optimize:clear');

        // Optimize packages
        $this->call('icons:cache');

        // Optimize caches
        $this->call('config:cache');
        $this->call('route:cache');
        $this->call('view:cache');
        $this->call('event:cache');

        // Reload octane
        $this->call('octane:reload');

        // Restart services
        $this->call('reverb:restart');
        $this->call('pulse:restart');
        $this->call('horizon:terminate');

        // Reset pulse
        $this->call('pulse:clear', ['--force' => true]);
    }
}
