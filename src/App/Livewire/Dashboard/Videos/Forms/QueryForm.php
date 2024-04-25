<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $recoverable = true;

    protected static bool $store = true;

    #[Validate('nullable|string|max:255')]
    public string $search = '';

    #[Validate('required|string|in:recent,random|max:255')]
    public string $sort = 'recent';

    #[Validate('required|array|in:verified,pending,failed')]
    public array $visibility = [];

    public function getSearch(): string
    {
        return str($this->get('search', ''))
            ->headline()
            ->squish()
            ->value();
    }
}
