<?php

namespace Foundation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class AppInstall extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * @var string
     */
    protected $description = 'Installs application';

    public function handle(): void
    {
        throw_unless($this->confirm('Are you sure to install the application?'));

        // Clear cache
        $this->call('optimize:clear');

        // Create symlinks
        $this->call('storage:link');

        // Perform update
        $this->call('app:update', ['--assets' => true, '--sync' => true]);
    }
}
