<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Domain\Videos\Models\Video;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class GeneralForm extends Form
{
    #[Validate('required|string|min:1|max:255')]
    public string $name = '';

    #[Validate('nullable|string|min:1|max:255')]
    public ?string $episode = null;

    #[Validate('nullable|string|min:1|max:255')]
    public ?string $season = null;

    #[Validate('nullable|decimal:0,4')]
    public ?float $snapshot = null;

    #[Validate(['tags' => 'nullable|array', 'tags.*.id' => 'exists:tags,prefixed_id'])]
    public array $tags = [];

    protected function beforeValidate(): void
    {
        collect($this->all())
            ->filter(fn (mixed $value) => is_string($value))
            ->each(fn (mixed $value, string $key) => data_set($this, $key, str($value)->squish()->value()));
    }

    protected function beforeFill(Video $model): array
    {
        $values = $model->only('name', 'episode', 'season', 'snapshot');

        $values['tags'] = $model->tags->options()->toArray();

        return $values;
    }
}
