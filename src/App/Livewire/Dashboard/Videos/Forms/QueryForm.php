<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    protected static bool $recoverable = true;

    #[Validate('nullable|string|max:100')]
    public string $query = '';

    #[Validate('nullable|string|in:recommended,relevance,recent,updated')]
    public string $sort = 'recommended';

    #[Validate('nullable|array|in:verified,pending,failed')]
    public array $visibility = [];

    public function query(): string
    {
        return str($this->get('query', ''))
            ->headline()
            ->squish()
            ->value();
    }

    protected function beforeValidate(): void
    {
        $this->sort = filled($this->query()) ? 'relevance' : $this->sort ?? 'recommended';
    }
}
