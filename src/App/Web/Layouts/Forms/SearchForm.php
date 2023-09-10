<?php

namespace App\Web\Layouts\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class SearchForm extends Form
{
    #[Rule('nullable|min:1|max:2')]
    public ?string $query = null;
}
