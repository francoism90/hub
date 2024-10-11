<?php

namespace App\Web\Videos\Forms;

use App\Web\Shared\Concerns\WithFormTranslations;
use Domain\Videos\Models\Video;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class GeneralForm extends Form
{
    use WithFormTranslations;

    #[Validate('required|string|min:1|max:255')]
    public ?string $name = null;

    #[Validate('nullable|string|min:1|max:255')]
    public ?string $episode = null;

    #[Validate('nullable|string|min:1|max:255')]
    public ?string $season = null;

    #[Validate('nullable|string|min:1|max:255')]
    public ?string $part = null;

    #[Validate('nullable|string|min:1|max:8096')]
    public ?string $summary = null;

    #[Validate('nullable|decimal:0,2')]
    public ?float $snapshot = null;

    #[Validate('nullable|date')]
    public ?string $released_at = null;

    #[Validate(['tags' => 'nullable|array', 'tags.*.id' => 'exists:tags,prefixed_id'])]
    public ?array $tags = [];

    protected function beforeValidate(): void
    {
        $this->setTranslations();
    }

    protected function beforeFill(Video $model): array
    {
        $translations = $this->getModelTranslations($model);

        $values = [...$model->toArray(), ...$translations];

        $values['tags'] = $model->tags->options()->toArray();

        return $values;
    }
}
