<?php

namespace Support\Structures\Commands;

use Foxws\WireUse\Scout\ComponentScout;
use Foxws\WireUse\Scout\LivewireScout;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class RefreshStructures extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'structures:refresh';

    /**
     * @var string
     */
    protected $description = 'Refresh Structure Scout indexes';

    public function handle(): void
    {
        ComponentScout::create()->clear();
        LivewireScout::create()->clear();

        $this->info('Cached structures cleared successfully.');
    }
}
