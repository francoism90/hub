<?php

declare(strict_types=1);

namespace Foundation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class AppUpdate extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'app:update {--assets}';

    /**
     * @var string
     */
    protected $description = 'Updates application';

    public function handle(): void
    {
        // Clear package caches
        $this->call('permission:cache-reset');
        $this->call('structures:refresh');

        // Clear application caches
        $this->call('optimize:clear');

        // Run migrations
        $this->call('migrate', ['--force' => true, '--seed' => true]);

        // Sync settings
        $this->call('scout:sync-index-settings');

        // Update assets
        if ($this->option('assets')) {
            $this->call('google-fonts:fetch');
        }

        // Optimize application
        $this->call('app:optimize');
    }
}
