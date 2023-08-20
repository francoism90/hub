<?php

namespace Domain\Tags\Commands;

use Domain\Tags\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Arr;

class CreateTag extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'tags:create {name} {type} {locale=en}';

    /**
     * @var string
     */
    protected $description = 'Create a new tag model';

    public function handle(): void
    {
        $model = Tag::findOrCreateFromString(
            ...Arr::except($this->arguments(), ['command'])
        );

        $this->info("Tag has been created: {$model->name} ({$model->getKey()})");
    }
}
