<?php

namespace App\Web\Search\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    protected static bool $recoverable = true;

    #[Validate('nullable|string|max:255')]
    public string $query = '';

    public function query(): string
    {
        return str($this->get('query', ''))
            ->title()
            ->squish()
            ->value();
    }
}
