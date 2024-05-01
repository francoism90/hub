<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class GeneralForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:255')]
    public ?string $episode = null;

    #[Validate('nullable|string|max:255')]
    public ?string $season = null;

    #[Validate('nullable|array|min:1|max:20|exists:tags,prefixed_id')]
    public array $tags = [];

    protected function beforeFill(Video $model): array
    {
        $values = $model->only('name', 'episode', 'season');

        $values['tags'] = $model->tags->routeKeys()->toArray();

        return $values;
    }
}