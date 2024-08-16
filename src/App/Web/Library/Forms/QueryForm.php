<?php

namespace App\Web\Library\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    protected static bool $recoverable = true;

    #[Validate('nullable|string|max:255')]
    public string $query = '';

    #[Validate('nullable|string|in:untagged,new')]
    public string $type = '';

    public function query(): string
    {
        return str($this->get('query', ''))
            ->headline()
            ->transliterate()
            ->squish()
            ->value();
    }
}
