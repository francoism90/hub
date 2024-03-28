<?php

namespace App\Videos\Forms;

use Domain\Tags\Rules\TagExists;
use Domain\Videos\Rules\FilterExists;
use Foxws\LivewireUse\Forms\Support\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    #[Validate]
    public string $search = '';

    public function hasTags(): bool
    {
        return $this->startsWith('search', 'tag:');
    }

    public function getTags(): array
    {
        return (array) $this->after('search', 'tag:');
    }

    public function rules(): array
    {
        return [
            'search' => [
                'nullable',
                'max:255',
                Rule::when(
                    fn ($input) => str($input->get('search'))->startsWith('tag:'),
                    ['nullable', 'string', new TagExists],
                ),
                Rule::when(
                    fn ($input) => str($input->get('search'))->startsWith('feed:'),
                    ['nullable', 'string', new FilterExists],
                ),
            ],
        ];
    }
}
