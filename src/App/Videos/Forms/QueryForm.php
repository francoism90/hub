<?php

namespace App\Videos\Forms;

use Foxws\LivewireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    protected static bool $store = true;

    #[Validate('nullable|string|max:255')]
    public string $search = '';
}
