<?php

namespace Domain\Videos\Commands;

use Domain\Imports\Actions\BulkImport;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class Import extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'videos:import {--force=true}';

    /**
     * @var string
     */
    protected $description = 'Optimizes application';

    public function handle(): void
    {
        throw_if(! $this->option('force') && ! $this->confirm('Are you sure to import videos?'));

        app(BulkImport::class)->execute();
    }
}
