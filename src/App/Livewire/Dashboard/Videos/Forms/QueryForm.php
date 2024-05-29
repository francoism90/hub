<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    protected static bool $recoverable = true;

    #[Validate('nullable|string|max:255')]
    public string $query = '';

    #[Validate('nullable|string|in:recent,updated')]
    public string $sort = '';

    #[Validate('nullable|array|in:verified,pending,failed')]
    public array $visibility = [];

    #[Validate('nullable|boolean')]
    public bool $untagged = false;

    public function query(): string
    {
        return str($this->get('query', ''))
            ->headline()
            ->squish()
            ->value();
    }
}
