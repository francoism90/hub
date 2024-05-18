<?php

namespace App\Livewire\Dashboard\Tags\Forms;

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

    protected function beforeValidate(): void
    {
        collect($this->all())
            ->filter(fn (mixed $value) => filled($value) && is_string($value))
            ->each(fn (mixed $value, string $key) => data_set($this, $key, str($value)->squish()->value()));
    }

    protected function beforeFill(Tag $model): array
    {
        $values = $model->only('name', 'description');

        $values['type'] = $model->type?->value;

        return $values;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'type' => [Rule::enum(TagType::class)],
        ];
    }
}
