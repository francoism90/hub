<?php

namespace Domain\Tags\Commands;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class CreateTag extends Command implements Isolatable
{
    /**
     * @var string
     */
    protected $signature = 'tags:create';

    /**
     * @var string
     */
    protected $description = 'Create a new tag';

    public function handle(): void
    {
        $name = text(
            label: 'Name',
            required: true,
        );

        $type = select(
            label: 'Type',
            options: TagType::cases(),
            required: true,
        );

        $model = Tag::firstOrCreate(compact('name', 'type'));

        $this->info("Tag has been created successfully ({$model->getKey()})");
    }
}
