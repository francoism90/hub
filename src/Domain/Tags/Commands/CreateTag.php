<?php

namespace Domain\Tags\Commands;

use Domain\Tags\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

class CreateTag extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'tags:create {name} {type=serie}';

    /**
     * @var string
     */
    protected $description = 'Create a new tag';

    public function handle(): void
    {
        Tag::firstOrCreate([
            'name' => $this->argument('name'),
            'type' => $this->argument('type'),
        ]);

        $this->info('Tag has been created successfully.');
    }
}
