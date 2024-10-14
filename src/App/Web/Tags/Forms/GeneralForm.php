<?php

declare(strict_types=1);

namespace App\Web\Tags\Forms;

use App\Web\Shared\Concerns\WithFormTranslations;
use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class GeneralForm extends Form
{
    use WithFormTranslations;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $type = '';

    #[Validate]
    public string $description = '';

    #[Validate(['related' => 'nullable|array', 'related.*.id' => 'exists:tags,prefixed_id'])]
    public array $related = [];

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'type' => ['required', Rule::enum(TagType::class)],
            'description' => 'nullable|string|min:1|max:4096',
        ];
    }

    protected function beforeValidate(): void
    {
        $this->setTranslations();
    }

    protected function beforeFill(Tag $model): array
    {
        $translations = $this->getModelTranslations($model);

        $values = [...$model->toArray(), ...$translations];

        $values['type'] = $model->type?->value;

        $values['related'] = $model->related->options()->toArray();

        return $values;
    }
}
