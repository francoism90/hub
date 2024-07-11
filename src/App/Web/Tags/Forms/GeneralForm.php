<?php

namespace App\Web\Tags\Forms;

use Domain\Tags\Enums\TagType;
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class GeneralForm extends Form
{
    #[Validate]
    public string $name = '';

    #[Validate]
    public string $type = '';

    #[Validate]
    public string $description = '';

    #[Validate(['related' => 'nullable|array', 'related.*.id' => 'exists:tags,prefixed_id'])]
    public array $related = [];

    protected function beforeValidate(): void
    {
        collect($this->all())
            ->filter(fn (mixed $value) => filled($value) && is_string($value))
            ->each(fn (mixed $value, string $key) => data_set($this, $key, str($value)->squish()->value()));
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'type' => [Rule::enum(TagType::class)],
            'description' => 'nullable|string|min:1|max:4096',
        ];
    }

    protected function beforeFill(Tag $model): array
    {
        $values = $model->only('name', 'description');

        $values['type'] = $model->type?->value;

        $values['related'] = $model->related->options()->toArray();

        return $values;
    }
}
