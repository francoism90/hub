<?php

namespace App\Web\Search\Forms;

use Foxws\LivewireUse\QueryBuilder\Forms\Form;
use Livewire\Attributes\Validate;

class SearchForm extends Form
{
    #[Validate('nullable|array|in:caption')]
    public ?array $feature = null;
}
