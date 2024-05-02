<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    #[Validate('nullable|string|max:100')]
    public string $query = '';

    #[Validate('nullable|string|in:recent,updated')]
    public string $sort = 'recent';

    public function query(): string
    {
        return str($this->get('query', ''))
            ->headline()
            ->squish()
            ->value();
    }
}
