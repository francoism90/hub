<?php

namespace App\Livewire\Dashboard\Videos\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Livewire\Attributes\Validate;

class QueryForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $sort = 'recent';
}
