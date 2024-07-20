<?php

namespace Domain\Tags\Commands;

use Domain\Tags\Actions\SetTagsOrder;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class SortTags extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'tags:sort {--force=true}';

    /**
     * @var string
     */
    protected $description = 'Set tags order';

    public function handle(): void
    {
        throw_if(! $this->option('force') && ! $this->confirm('Are you sure to sort tags?'));

        app(SetTagsOrder::class)->execute();

        $this->info('Tags have been sorted successfully.');
    }
}
