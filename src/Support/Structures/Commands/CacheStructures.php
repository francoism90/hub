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
        $this->createComponentCache();
        $this->createLivewireCache();
    }

    protected function createComponentCache(): void
    {
        $this->components->info('Creating component cache...');

        ComponentScout::create()->register();

        $this->components->info('Component cache created successfully.');
    }

    protected function createLivewireCache(): void
    {
        $this->components->info('Creating Livewire cache...');

        LivewireScout::create()->register();

        $this->components->info('Livewire cache created successfully.');
    }
}
