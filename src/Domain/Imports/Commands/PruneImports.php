<?php

namespace Domain\Imports\Commands;

use Domain\Imports\Models\Import;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class PruneImports extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'imports:prune';

    /**
     * @var string
     */
    protected $description = 'Prune import models';

    public function handle(): void
    {
        $this->call('model:prune', ['--model' => Import::class]);
    }
}
