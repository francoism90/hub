<?php

declare(strict_types=1);

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

        // Perform update
        $this->call('app:update', ['--assets' => true]);
    }
}
