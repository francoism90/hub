<?php

declare(strict_types=1);

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
    protected $signature = 'structures:clear';

    /**
     * @var string
     */
    protected $description = 'Refresh component structures';

    public function handle(): void
    {
        ComponentScout::create()->clear();
        LivewireScout::create()->clear();

        $this->components->info('Structure cache cleared successfully.');
    }
}
