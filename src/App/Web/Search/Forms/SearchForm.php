<?php

namespace App\Web\Search\Forms;

use Foxws\LivewireUse\Forms\Concerns\WithSearch;
use Foxws\LivewireUse\Forms\Concerns\WithSorts;
use Foxws\LivewireUse\QueryBuilder\Forms\QueryBuilderForm;
use Livewire\Attributes\Validate;

class SearchForm extends QueryBuilderForm
{
    use WithSearch;
    use WithSorts;

    #[Validate('nullable|array|in:caption')]
    public ?array $feature = null;
}
