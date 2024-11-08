<?php

declare(strict_types=1);

namespace Support\Structures\Commands;

use Foxws\WireUse\Scout\ComponentScout;
use Foxws\WireUse\Scout\LivewireScout;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class CacheStructures extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'structures:cache';

    /**
     * @var string
     */
    protected $description = 'Cache component structures';

    public function handle(): void
    {
        ComponentScout::create(app_path('Web'), 'App\\')->register();
        LivewireScout::create(app_path('Web'), 'App\\')->register();

        $this->components->info('Component structure cached successfully.');
    }
}
