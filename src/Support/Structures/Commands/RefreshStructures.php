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
        $this->clearComponentCache();
        $this->clearLivewireCache();
    }

    protected function clearComponentCache(): void
    {
        $this->components->info('Clearing component cache...');

        ComponentScout::create()->clear();

        $this->components->info('Component cache cleared successfully.');
    }

    protected function clearLivewireCache(): void
    {
        $this->components->info('Clearing Livewire cache...');

        LivewireScout::create()->clear();

        $this->components->info('Livewire cache cleared successfully.');
    }
}
