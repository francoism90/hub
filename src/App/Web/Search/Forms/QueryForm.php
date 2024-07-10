<?php

namespace App\Web\Search\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Support\Stringable;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    // protected static bool $store = true;

    #[Validate('nullable|string|max:1')]
    public string $query = '';

    public function query(): ?Stringable
    {
        return str($this->get('query', ''))
            ->title()
            ->squish();
    }
}
