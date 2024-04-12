<?php

namespace App\Videos\Forms;

use Domain\Videos\Rules\FilterExists;
use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    #[Validate]
    public string $search = '';

    public function query(): string
    {
        return str($this->get('search', ''))
            ->replaceMatches('/filter:(\w*)/', '')
            ->squish()
            ->value();
    }

    public function filters(): array
    {
        return str($this->get('search', ''))
            ->matchAll('/filter:(\w*)/')
            ->all();
    }

    public function filter(string $needle): bool
    {
        return in_array($needle, $this->filters());
    }

    public function rules(): array
    {
        return [
            'search' => [
                'nullable',
                'max:255',
                new FilterExists,
            ],
        ];
    }
}
