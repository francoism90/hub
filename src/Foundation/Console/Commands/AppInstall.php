<?php

namespace Foundation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class AppInstall extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'app:install {--force}';

    /**
     * @var string
     */
    protected $description = 'Installs the application';

    public function handle(): void
    {
        throw_if(! $this->option('force') && ! $this->confirm('Are you sure to install the application?'));

        // Clear cache
        $this->call('cache:clear');
        $this->call('optimize:clear');

        // Delete indexes
        $this->call('scout:delete-all-indexes');

        // Perform update
        $this->call('app:update');
    }
}
