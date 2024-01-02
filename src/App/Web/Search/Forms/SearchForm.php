<?php

namespace App\Web\Search\Forms;

use Foxws\LivewireUse\QueryBuilder\Forms\FilterForm;
use Livewire\Attributes\Validate;

class SearchForm extends FilterForm
{
    #[Validate('nullable|array|in:caption')]
    public ?array $feature = null;
}
