<?php

namespace App\Web\Videos\Forms;

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

    #[Validate('nullable|string|min:1|max:255')]
    public ?string $part = null;

    #[Validate('nullable|date')]
    public ?string $released_at = null;

    #[Validate('nullable|decimal:0,4')]
    public ?float $snapshot = null;

    #[Validate(['tags' => 'nullable|array', 'tags.*.id' => 'exists:tags,prefixed_id'])]
    public array $tags = [];

    protected function beforeValidate(): void
    {
        collect($this->all())
            ->filter(fn (mixed $value) => filled($value) && is_string($value))
            ->each(fn (mixed $value, string $key) => data_set($this, $key, str($value)->squish()->value()));
    }

    protected function beforeFill(Video $model): array
    {
        $translations = collect($model->getTranslations())
            ->map(fn (?array $item) => data_get($item, app()->getLocale(), ''))
            ->toArray();

        $values = [...$model->toArray(), ...$translations];

        // Convert tags to options
        $values['tags'] = $model->tags->options()->toArray();

        return $values;
    }
}
